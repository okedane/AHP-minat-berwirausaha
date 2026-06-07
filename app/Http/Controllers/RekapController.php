<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
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

        // Build lightweight rekaps list (don't expand full jawaban here)
        $rekaps = $users->map(function ($user) {
            $hasilQuesioners = $user->hasilQuesioners;

            $nilaiAkhir = 0;
            $kategoriInfo = [];
            $usahasRekomendasi = [];

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
                                'nama_usaha' => $usaha->nama_usaha ?? $usaha->nama ?? '-',
                                'deskripsi' => $usaha->deskripsi ?? '-',
                            ];
                        })->toArray();
                }
            }

            return [
                'user' => $user,
                'nilai_akhir' => $nilaiAkhir,
                'kategoriInfo' => $kategoriInfo,
                'usahasRekomendasi' => $usahasRekomendasi,
            ];
        });

        return view('ahli.rekap.rekap', compact('rekaps'));
    }

    /**
     * Show detail page for a user's historical hasil kuesioner entries.
     */
    public function show($id)
    {
        $user = User::with('hasilQuesioners.klasifikasiPenilaian.usahas')->findOrFail($id);

        // Map hasil kuesioners into simple items for the detail page
        $kriteria = $user->hasilQuesioners->map(function ($hasil) {
            $kategori = $hasil->klasifikasiPenilaian->nama_kategori ?? '-';
            $rekomendasiUtama = '-';
            if ($hasil->klasifikasiPenilaian && $hasil->klasifikasiPenilaian->usahas->isNotEmpty()) {
                $first = $hasil->klasifikasiPenilaian->usahas->first();
                    $rekomendasiUtama = $first->nama_usaha ?? $first->nama ?? '-';
            }

            return (object) [
                'nilai_akhir' => $hasil->nilai_akhir ?? '-',
                'kategori' => $kategori,
                'rekomendasi_utama' => $rekomendasiUtama,
                'created_at' => $hasil->created_at,
            ];
        });

        return view('ahli.rekap.detail', compact('kriteria'));
    }
}
