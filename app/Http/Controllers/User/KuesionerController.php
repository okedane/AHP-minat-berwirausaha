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
    public function kuesioner()
    {
        $kriteria = Kriteria::with('pertanyaans')
            ->orderBy('id')
            ->get()
            ->map(fn($k) => [
                'id'         => $k->id,
                'kode'       => $k->kode,
                'nama'       => $k->nama,
                'bobot'      => (float) $k->bobot,
                'pertanyaan' => $k->pertanyaans->pluck('pertanyaan')->toArray(),
            ])
            ->values()
            ->toArray();

        $skala = [
            ['label' => 'Sangat Tidak Setuju', 'nilai' => 1],
            ['label' => 'Tidak Setuju',         'nilai' => 2],
            ['label' => 'Netral',                'nilai' => 3],
            ['label' => 'Setuju',                'nilai' => 4],
            ['label' => 'Sangat Setuju',         'nilai' => 5],
        ];

        return view('user.kuesioner.kuesioner', compact('kriteria', 'skala'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jawaban'     => 'required|array',
            'jawaban.*'   => 'array',
            'jawaban.*.*' => 'required|integer|min:1|max:5',
        ]);

        $jawabanRaw   = $request->input('jawaban');
        $kriteriaList = Kriteria::orderBy('id')->get();

        $nilaiPerKriteria = [];
        $nilaiAkhir       = 0;

        foreach ($kriteriaList as $ki => $k) {
            $jawaban = array_values($jawabanRaw[$ki] ?? []);
            $avg     = count($jawaban) > 0
                ? round(array_sum($jawaban) / count($jawaban), 4)
                : 0;

            $nilaiTerbobot  = round($avg * (float) $k->bobot, 4);
            $nilaiAkhir    += $nilaiTerbobot;

            $nilaiPerKriteria[] = [
                'kriteria_id'    => $k->id,
                'kode'           => $k->kode,
                'nama'           => $k->nama,
                'bobot'          => (float) $k->bobot,
                'nilai'          => $avg,
                'nilai_terbobot' => $nilaiTerbobot,
            ];
        }

        $nilaiAkhir = round($nilaiAkhir, 3);

        $klasifikasi = KlasifikasiPenilaian::where('nilai_min', '<=', $nilaiAkhir)
            ->where('nilai_max', '>=', $nilaiAkhir)
            ->first();

        $hasil = HasilKuesioner::create([
            'user_id'                  => Auth::id(),
            'klasifikasi_penilaian_id' => $klasifikasi?->id,
            'nilai_akhir'              => $nilaiAkhir,
            'nilai_per_kriteria'       => json_encode($nilaiPerKriteria),
            'jawaban_raw'              => json_encode($jawabanRaw),
        ]);

        return redirect()->route('user.hasil', $hasil->id);
    }

    // public function hasil($id = null)
    // {
    //     $query = HasilKuesioner::with(['klasifikasiPenilaian.usahas'])
    //         ->where('user_id', Auth::id());

    //     $hasilModel = $id
    //         ? $query->findOrFail($id)
    //         : $query->latest()->firstOrFail();

    //     $klasifikasi = $hasilModel->klasifikasiPenilaian;

    //     $hasil = [
    //         'nilai_akhir'        => $hasilModel->nilai_akhir,
    //         'kategori'           => $klasifikasi?->nama_kategori ?? '-',
    //         'deskripsi'          => $klasifikasi?->deskripsi ?? '-',
    //         'nilai_per_kriteria' => json_decode($hasilModel->nilai_per_kriteria, true) ?? [],
    //         'rekomendasi'        => $klasifikasi?->usahas?->map(fn($u) => [
    //             'nama' => $u->nama_usaha,
    //             'desc' => $u->deskripsi ?? '',
    //         ])->toArray() ?? [],
    //     ];

    //     return view('user.hasil.hasil', compact('hasil'));
    // }

    public function hasil($id = null)
    {
        $query = HasilKuesioner::with(['klasifikasiPenilaian.usahas'])
            ->where('user_id', Auth::id());

        $hasilModel = $id
            ? $query->findOrFail($id)
            : $query->latest()->firstOrFail();

        $klasifikasi = $hasilModel->klasifikasiPenilaian;

        $hasil = [
            'nilai_akhir'        => $hasilModel->nilai_akhir,
            'kategori'           => $klasifikasi?->nama_kategori ?? '-',
            'deskripsi'          => $klasifikasi?->deskripsi ?? '-',
            'nilai_per_kriteria' => json_decode($hasilModel->nilai_per_kriteria, true) ?? [],
            'rekomendasi'        => $klasifikasi?->usahas?->map(fn($u) => [
                'nama' => $u->nama_usaha,
                'desc' => $u->deskripsi ?? '',
            ])->toArray() ?? [],
        ];

        return view('user.hasil.hasil', compact('hasil'));
    }

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
}
