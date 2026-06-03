<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->where('role', 'user')
            ->with(['hasilQuesioners.klasifikasiPenilaian.usahas'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get();

        // Load kriteria dan pertanyaan untuk mapping
        $kriterias = Kriteria::with('pertanyaans')->orderBy('id')->get();

        $rekaps = $users->map(function ($user) use ($kriterias) {
            $hasilQuesioners = $user->hasilQuesioners;
            
            $details = [];
            $nilaiAkhir = 0;
            $kategoriInfo = [];
            $usahasRekomendasi = [];

            // Ambil data dari hasil kuesioner terakhir
            if ($hasilQuesioners->isNotEmpty()) {
                $hasilTerakhir = $hasilQuesioners->first();
                $nilaiAkhir = $hasilTerakhir->nilai_akhir ?? 0;
                
                if ($hasilTerakhir->klasifikasiPenilaian) {
                    $kategoriInfo = [
                        'id' => $hasilTerakhir->klasifikasiPenilaian->id,
                        'nama_kategori' => $hasilTerakhir->klasifikasiPenilaian->nama_kategori,
                        'deskripsi' => $hasilTerakhir->klasifikasiPenilaian->deskripsi,
                    ];
                    $usahasRekomendasi = $hasilTerakhir->klasifikasiPenilaian->usahas->map(function ($usaha) {
                        return [
                            'id' => $usaha->id,
                            'nama' => $usaha->nama,
                            'deskripsi' => $usaha->deskripsi,
                        ];
                    })->toArray();
                }
                
                // Expand jawaban_raw detail untuk tabel detail di modal
                $jawabanRaw = json_decode($hasilTerakhir->jawaban_raw, true) ?? [];
                
                foreach ($kriterias as $ki => $kriteria) {
                    $pertanyaanList = $kriteria->pertanyaans ?? [];
                    $jawabans = $jawabanRaw[$ki] ?? [];

                    foreach ($pertanyaanList as $qj => $pertanyaan) {
                        $nilai = $jawabans[$qj] ?? 0;
                        $details[] = [
                            'kriteria_nama' => $kriteria->nama,
                            'pertanyaan_text' => $pertanyaan->pertanyaan,
                            'nilai' => $nilai,
                        ];
                    }
                }
            }

            return [
                'user' => $user,
                'details' => collect($details),
                'nilai_akhir' => $nilaiAkhir,
                'kategoriInfo' => $kategoriInfo,
                'usahasRekomendasi' => $usahasRekomendasi,
            ];
        });

        return view('admin.rekap.rekap', compact('rekaps'));
    }
}
