<?php
// app/Http/Controllers/User/KuesionerController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\KlasifikasiPenilaian;
use App\Models\HasilKuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuesionerController extends Controller
{
    // ══════════════════════════════════════════════
    // HELPER — emoji per kode kriteria
    // ══════════════════════════════════════════════
    private function getEmoji(string $kode): string
    {
        return match (strtoupper(trim($kode))) {
            'C1'    => '🔥',
            'C2'    => '💪',
            'C3'    => '📚',
            'C4'    => '🤝',
            'C5'    => '💰',
            default => '📌',
        };
    }

    // ══════════════════════════════════════════════
    // TAMPILKAN KUESIONER
    // GET /kuesioner  →  name: user.kuesioner
    // ══════════════════════════════════════════════
    public function kuesioner()
    {
        $kriteriaDB = Kriteria::with(['pertanyaans' => fn($q) => $q->orderBy('id')])
            ->orderBy('id')
            ->get();

        // Format array yang akan diinjeksi ke JavaScript
        $kriteria = $kriteriaDB->map(fn($k) => [
            'id'         => $k->id,
            'kode'       => $k->kode,
            'nama'       => $k->nama,
            'bobot'      => (float) $k->bobot,
            'emoji'      => $this->getEmoji($k->kode),
            'pertanyaan' => $k->pertanyaans->pluck('pertanyaan')->toArray(),
        ])->values()->toArray();

        // Skala Likert — tidak perlu dari DB karena selalu sama
        $skala = [
            ['label' => 'Sangat Tidak Setuju', 'nilai' => 1],
            ['label' => 'Tidak Setuju',         'nilai' => 2],
            ['label' => 'Netral',                'nilai' => 3],
            ['label' => 'Setuju',                'nilai' => 4],
            ['label' => 'Sangat Setuju',         'nilai' => 5],
        ];

        return view('user.kuesioner.kuesioner', compact('kriteria', 'skala'));
    }

    // ══════════════════════════════════════════════
    // PROSES SUBMIT & HITUNG AHP
    // POST /kuesioner  →  name: user.kuesioner.store
    // ══════════════════════════════════════════════
    public function store(Request $request)
    {
        $request->validate([
            'jawaban'     => 'required|array',
            'jawaban.*'   => 'array',
            'jawaban.*.*' => 'required|integer|min:1|max:5',
        ]);

        $jawabanRaw   = $request->input('jawaban');
        $kriteriaList = Kriteria::orderBy('id')->get();

        // ── HITUNG NILAI AKHIR AHP ──
        $nilaiPerKriteria = [];
        $nilaiAkhir       = 0;

        foreach ($kriteriaList as $ki => $k) {
            $jawabanKriteria = array_values($jawabanRaw[$ki] ?? []);
            $avg = count($jawabanKriteria) > 0
                ? array_sum($jawabanKriteria) / count($jawabanKriteria)
                : 0;

            $nilaiTerbobot = round($avg * (float) $k->bobot, 6);
            $nilaiAkhir   += $nilaiTerbobot;

            $nilaiPerKriteria[] = [
                'kriteria_id'    => $k->id,
                'kode'           => $k->kode,
                'nama'           => $k->nama,
                'emoji'          => $this->getEmoji($k->kode),
                'bobot'          => (float) $k->bobot,
                'nilai'          => round($avg, 4),
                'nilai_terbobot' => $nilaiTerbobot,
            ];
        }

        $nilaiAkhir = round($nilaiAkhir, 3);

        // ── TENTUKAN KLASIFIKASI ──
        $klasifikasi = KlasifikasiPenilaian::where('nilai_min', '<=', $nilaiAkhir)
            ->where('nilai_max', '>=', $nilaiAkhir)
            ->first();

        // Fallback jika tabel klasifikasi belum diisi
        if (!$klasifikasi) {
            $klasifikasi = $this->fallbackKlasifikasi($nilaiAkhir);
        }

        // ── SIMPAN KE DATABASE ──
        $hasil = HasilKuesioner::create([
            'user_id'                  => Auth::id(),
            'klasifikasi_penilaian_id' => $klasifikasi->id ?? null,
            'nilai_akhir'              => $nilaiAkhir,
            'nilai_per_kriteria'       => json_encode($nilaiPerKriteria),
            'jawaban_raw'              => json_encode($jawabanRaw),
        ]);

        return redirect()->route('user.hasil', ['id' => $hasil->id])
            ->with('success', 'Kuesioner berhasil disubmit!');
    }

    // ══════════════════════════════════════════════
    // TAMPILKAN HASIL
    // GET /hasil/{id}  →  name: user.hasil
    // ══════════════════════════════════════════════
    public function hasil(Request $request, $id = null)
    {
        // Ambil berdasarkan ID atau hasil terakhir user
        $hasilModel = $id
            ? HasilKuesioner::with(['klasifikasiPenilaian.usahas'])
            ->where('user_id', Auth::id())
            ->findOrFail($id)
            : HasilKuesioner::with(['klasifikasiPenilaian.usahas'])
            ->where('user_id', Auth::id())
            ->latest()
            ->firstOrFail();

        $klasifikasi      = $hasilModel->klasifikasiPenilaian;
        $nilaiPerKriteria = json_decode($hasilModel->nilai_per_kriteria, true) ?? [];

        // Rekomendasi dari tabel usahas
        $rekomendasi = $klasifikasi?->usahas?->map(fn($u) => [
            'icon' => $u->icon ?? '💡',
            'nama' => $u->nama_usaha,
            'desc' => $u->deskripsi ?? '',
        ])->toArray() ?? $this->fallbackRekomendasi($hasilModel->nilai_akhir);

        $hasil = [
            'nilai_akhir'        => $hasilModel->nilai_akhir,
            'kategori'           => $klasifikasi?->nama_kategori ?? '-',
            'deskripsi'          => $klasifikasi?->deskripsi ?? '-',
            'nilai_per_kriteria' => $nilaiPerKriteria,
            'rekomendasi'        => $rekomendasi,
        ];

        return view('user.hasil.hasil', compact('hasil'));
    }

    // ══════════════════════════════════════════════
    // TAMPILKAN REKAP
    // GET /rekap  →  name: user.rekap
    // ══════════════════════════════════════════════
    public function rekap()
    {
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

    // ══════════════════════════════════════════════
    // FALLBACK — jika tabel DB belum diisi
    // ══════════════════════════════════════════════
    private function fallbackKlasifikasi(float $nilai): object
    {
        if ($nilai > 3.67) {
            return (object)[
                'id' => null,
                'nama_kategori' => 'Tinggi',
                'deskripsi' => 'Minat berwirausaha Anda sangat kuat! Anda adalah kandidat ideal untuk mengikuti program inkubasi bisnis kampus.'
            ];
        }
        if ($nilai >= 2.33) {
            return (object)[
                'id' => null,
                'nama_kategori' => 'Sedang',
                'deskripsi' => 'Minat Anda cukup baik dan berpotensi berkembang. Dengan pendampingan yang tepat, Anda bisa menjadi wirausahawan sukses.'
            ];
        }
        return (object)[
            'id' => null,
            'nama_kategori' => 'Rendah',
            'deskripsi' => 'Minat wirausaha Anda masih perlu dikembangkan. Mulailah dengan usaha kecil berrisiko rendah.'
        ];
    }

    private function fallbackRekomendasi(float $nilai): array
    {
        if ($nilai > 3.67) return [
            ['icon' => '🚀', 'nama' => 'Startup Digital',      'desc' => 'Aplikasi, SaaS, atau platform berbasis teknologi'],
            ['icon' => '🏷️', 'nama' => 'Brand Produk Sendiri',  'desc' => 'Fashion, kosmetik, atau produk UMKM inovatif'],
            ['icon' => '🎨', 'nama' => 'Agensi Kreatif',        'desc' => 'Marketing digital, desain, konten media'],
            ['icon' => '🍽️', 'nama' => 'Kuliner Skala Besar',   'desc' => 'Cloud kitchen, franchise, atau katering'],
        ];
        if ($nilai >= 2.33) return [
            ['icon' => '🍜', 'nama' => 'Usaha Kuliner Rumahan', 'desc' => 'Katering, minuman, atau snack kemasan'],
            ['icon' => '✏️', 'nama' => 'Freelance Kreatif',      'desc' => 'Desain poster, video, atau copywriting'],
            ['icon' => '🛍️', 'nama' => 'Toko Online',            'desc' => 'Jual produk sendiri atau kurasi di marketplace'],
            ['icon' => '📖', 'nama' => 'Jasa Les Privat',        'desc' => 'Bimbingan belajar sesuai bidang studi'],
        ];
        return [
            ['icon' => '📦', 'nama' => 'Reseller Online',       'desc' => 'Jual produk orang lain tanpa produksi sendiri'],
            ['icon' => '🚚', 'nama' => 'Dropship',              'desc' => 'Modal kecil, risiko rendah, cocok untuk pemula'],
            ['icon' => '🛒', 'nama' => 'Jasa Titip (Jastip)',   'desc' => 'Mudah dimulai, cocok untuk mahasiswa aktif'],
            ['icon' => '🍿', 'nama' => 'Jualan Makanan Ringan', 'desc' => 'Di lingkungan kampus, modal terjangkau'],
        ];
    }
}
