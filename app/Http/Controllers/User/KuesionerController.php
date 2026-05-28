<?php
// app/Http/Controllers/User/KuesionerController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Pertanyaan;
use App\Models\KlasifikasiPenilaian;
use App\Models\HasilKuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuesionerController extends Controller
{
    // ══════════════════════════════════════════════════════
    // TAMPILKAN HALAMAN KUESIONER
    // Route: GET /kuesioner → name: user.kuesioner
    // ══════════════════════════════════════════════════════
    public function kuesioner()
    {
        // Ambil kriteria + pertanyaan dari database
        // (sesuai tabel kriterias dan pertanyaans Anda)
        $kriteriaList = Kriteria::with(['pertanyaans' => function ($q) {
            $q->orderBy('urutan');
        }])->orderBy('id')->get();

        // Format untuk dikirim ke JavaScript (window.KRITERIA)
        $kriteria = $kriteriaList->map(fn($k) => [
            'id'          => $k->id,
            'nama'        => $k->nama,
            'kode'        => $k->kode,
            'bobot'       => (float) $k->bobot,
            'emoji'       => $this->getEmoji($k->kode),
            'pertanyaan'  => $k->pertanyaans->pluck('pertanyaan')->toArray(),
        ])->values()->toArray();

        // Skala Likert
        $skala = [
            ['label' => 'Sangat Tidak Setuju', 'nilai' => 1],
            ['label' => 'Tidak Setuju',         'nilai' => 2],
            ['label' => 'Netral',                'nilai' => 3],
            ['label' => 'Setuju',                'nilai' => 4],
            ['label' => 'Sangat Setuju',         'nilai' => 5],
        ];

        return view('user.kuesioner.kuesioner', compact('kriteria', 'skala'));
    }

    // ══════════════════════════════════════════════════════
    // PROSES SUBMIT KUESIONER & HITUNG AHP
    // Route: POST /kuesioner → name: user.kuesioner.store
    // ══════════════════════════════════════════════════════
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jawaban'     => 'required|array',
            'jawaban.*'   => 'array',
            'jawaban.*.*' => 'required|integer|min:1|max:5',
        ]);

        $jawabanRaw = $request->input('jawaban');

        // Ambil kriteria dari database (sudah ada bobotnya)
        $kriteriaList = Kriteria::orderBy('id')->get();

        // ── HITUNG NILAI PER KRITERIA & NILAI AKHIR AHP ──
        $nilaiPerKriteria = [];
        $nilaiAkhir       = 0;

        foreach ($kriteriaList as $ki => $k) {
            $jawaban = array_values($jawabanRaw[$ki] ?? []);

            // Rata-rata jawaban = Nilai kriteria
            $avg = count($jawaban) > 0
                ? array_sum($jawaban) / count($jawaban)
                : 0;

            // Nilai terbobot = rata-rata × bobot AHP
            $nilaiTerbobot = $avg * (float) $k->bobot;
            $nilaiAkhir   += $nilaiTerbobot;

            $nilaiPerKriteria[] = [
                'kriteria_id'    => $k->id,
                'nama'           => $k->nama,
                'kode'           => $k->kode,
                'emoji'          => $this->getEmoji($k->kode),
                'bobot'          => (float) $k->bobot,
                'nilai'          => round($avg, 4),
                'nilai_terbobot' => round($nilaiTerbobot, 4),
            ];
        }

        $nilaiAkhir = round($nilaiAkhir, 3);

        // ── TENTUKAN KLASIFIKASI ──
        // Cari dari tabel klasifikasi_penilaians berdasarkan nilai_min & nilai_max
        $klasifikasi = KlasifikasiPenilaian::where('nilai_min', '<=', $nilaiAkhir)
            ->where('nilai_max', '>=', $nilaiAkhir)
            ->first();

        // Fallback jika tidak ditemukan (data DB belum diisi)
        if (!$klasifikasi) {
            $klasifikasi = $this->getFallbackKlasifikasi($nilaiAkhir);
        }

        // ── SIMPAN KE DATABASE ──
        $hasil = HasilKuesioner::create([
            'user_id'                 => Auth::id(),
            'klasifikasi_penilaian_id'=> $klasifikasi->id ?? null,
            'nilai_akhir'             => $nilaiAkhir,
            'nilai_per_kriteria'      => json_encode($nilaiPerKriteria),
            'jawaban_raw'             => json_encode($jawabanRaw),
        ]);

        // ── REDIRECT KE HALAMAN HASIL ──
        return redirect()->route('user.hasil', ['id' => $hasil->id]);
    }

    // ══════════════════════════════════════════════════════
    // TAMPILKAN HALAMAN HASIL
    // Route: GET /hasil/{id} → name: user.hasil
    // ══════════════════════════════════════════════════════
    public function hasil($id = null)
    {
        // Jika ada ID, ambil dari database
        // Jika tidak, ambil hasil terakhir user yang login
        $hasilModel = $id
            ? HasilKuesioner::with(['klasifikasiPenilaian.usahas'])->findOrFail($id)
            : HasilKuesioner::with(['klasifikasiPenilaian.usahas'])
                ->where('user_id', Auth::id())
                ->latest()
                ->firstOrFail();

        // Pastikan hanya pemilik yang bisa lihat
        if ($hasilModel->user_id !== Auth::id()) {
            abort(403);
        }

        $klasifikasi      = $hasilModel->klasifikasiPenilaian;
        $nilaiPerKriteria = json_decode($hasilModel->nilai_per_kriteria, true);

        // Rekomendasi usaha dari relasi
        $rekomendasi = $klasifikasi?->usahas?->map(fn($u) => [
            'icon' => $u->icon ?? '💡',
            'nama' => $u->nama_usaha,
            'desc' => $u->deskripsi ?? '',
        ])->toArray() ?? $this->getFallbackRekomendasi($hasilModel->nilai_akhir);

        $hasil = [
            'nilai_akhir'        => $hasilModel->nilai_akhir,
            'kategori'           => $klasifikasi?->nama_kategori ?? '-',
            'deskripsi'          => $klasifikasi?->deskripsi ?? '-',
            'nilai_per_kriteria' => $nilaiPerKriteria,
            'rekomendasi'        => $rekomendasi,
        ];

        return view('user.hasil.hasil', compact('hasil'));
    }

    // ══════════════════════════════════════════════════════
    // TAMPILKAN HALAMAN REKAP
    // Route: GET /rekap → name: user.rekap
    // ══════════════════════════════════════════════════════
    public function rekap()
    {
        // Rekap hanya untuk hasil user yang sedang login
        $rekap = HasilKuesioner::with('klasifikasiPenilaian')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        $stats = [
            'tinggi' => HasilKuesioner::where('user_id', Auth::id())
                ->whereHas('klasifikasiPenilaian', fn($q) => $q->where('nama_kategori', 'Tinggi'))
                ->count(),
            'sedang' => HasilKuesioner::where('user_id', Auth::id())
                ->whereHas('klasifikasiPenilaian', fn($q) => $q->where('nama_kategori', 'Sedang'))
                ->count(),
            'rendah' => HasilKuesioner::where('user_id', Auth::id())
                ->whereHas('klasifikasiPenilaian', fn($q) => $q->where('nama_kategori', 'Rendah'))
                ->count(),
        ];

        return view('user.rekap.rekap', compact('rekap', 'stats'));
    }

    // ══════════════════════════════════════════════════════
    // HELPER METHODS
    // ══════════════════════════════════════════════════════

    /** Emoji per kode kriteria */
    private function getEmoji(string $kode): string
    {
        return match(strtoupper($kode)) {
            'C1'    => '🔥',
            'C2'    => '💪',
            'C3'    => '📚',
            'C4'    => '🤝',
            'C5'    => '💰',
            default => '📌',
        };
    }

    /**
     * Fallback klasifikasi jika tabel klasifikasi_penilaians kosong
     * Sesuai rumus equal interval: (5-1)/3 = 1.33
     * Rendah < 2.33 | Sedang 2.33-3.67 | Tinggi > 3.67
     */
    private function getFallbackKlasifikasi(float $nilaiAkhir): object
    {
        if ($nilaiAkhir > 3.67) {
            return (object)[
                'id'            => null,
                'nama_kategori' => 'Tinggi',
                'deskripsi'     => 'Minat berwirausaha Anda sangat kuat! Anda adalah kandidat ideal untuk mengikuti program inkubasi bisnis kampus.',
            ];
        } elseif ($nilaiAkhir >= 2.33) {
            return (object)[
                'id'            => null,
                'nama_kategori' => 'Sedang',
                'deskripsi'     => 'Minat Anda cukup baik dan berpotensi berkembang. Dengan pendampingan yang tepat, Anda bisa menjadi wirausahawan sukses.',
            ];
        }
        return (object)[
            'id'            => null,
            'nama_kategori' => 'Rendah',
            'deskripsi'     => 'Minat wirausaha Anda masih perlu dikembangkan. Mulailah dengan usaha kecil berrisiko rendah.',
        ];
    }

    /** Fallback rekomendasi jika tabel usahas kosong */
    private function getFallbackRekomendasi(float $nilaiAkhir): array
    {
        if ($nilaiAkhir > 3.67) {
            return [
                ['icon' => '🚀', 'nama' => 'Startup Digital',      'desc' => 'Aplikasi, SaaS, atau platform berbasis teknologi'],
                ['icon' => '🏷️', 'nama' => 'Brand Produk Sendiri',  'desc' => 'Fashion, kosmetik, atau produk UMKM inovatif'],
                ['icon' => '🎨', 'nama' => 'Agensi Kreatif',        'desc' => 'Marketing digital, desain, konten media'],
                ['icon' => '🍽️', 'nama' => 'Kuliner Skala Besar',   'desc' => 'Cloud kitchen, franchise, atau katering'],
            ];
        } elseif ($nilaiAkhir >= 2.33) {
            return [
                ['icon' => '🍜', 'nama' => 'Usaha Kuliner Rumahan', 'desc' => 'Katering, minuman, atau snack kemasan'],
                ['icon' => '✏️', 'nama' => 'Freelance Kreatif',      'desc' => 'Desain poster, video, atau copywriting'],
                ['icon' => '🛍️', 'nama' => 'Toko Online',            'desc' => 'Jual produk sendiri atau kurasi di marketplace'],
                ['icon' => '📖', 'nama' => 'Jasa Les Privat',        'desc' => 'Bimbingan belajar sesuai bidang studi'],
            ];
        }
        return [
            ['icon' => '📦', 'nama' => 'Reseller Online',       'desc' => 'Jual produk orang lain tanpa produksi sendiri'],
            ['icon' => '🚚', 'nama' => 'Dropship',              'desc' => 'Modal kecil, risiko rendah, cocok untuk pemula'],
            ['icon' => '🛒', 'nama' => 'Jasa Titip (Jastip)',   'desc' => 'Mudah dimulai, cocok untuk mahasiswa aktif'],
            ['icon' => '🍿', 'nama' => 'Jualan Makanan Ringan', 'desc' => 'Di lingkungan kampus, modal terjangkau'],
        ];
    }
}