<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\PerbadinganKriteria;
use Illuminate\Http\Request;

class PerbadinganKriteriaController extends Controller
{
    /**
     * Tampilkan halaman matriks perbandingan kriteria AHP.
     */
    public function index()
    {
        $kriterias = Kriteria::orderBy('id')->get();
        $ids       = $kriterias->pluck('id')->toArray();

        // Ambil hanya pasangan i < j dari DB (nilai asli yang diinput user)
        // Kebalikan (j, i) = 1/nilai — dihitung di sini, TIDAK disimpan ke DB
        $matriks = $this->bangunMatriks($kriterias, $ids);

        $lengkap     = $this->cekLengkap($ids, $matriks);
        $hasil        = null;
        $konsistensi  = null;

        if ($lengkap) {
            $hasil       = $this->hitungNormalisasi($ids, $matriks);
            $konsistensi = $this->hitungKonsistensi($ids, $matriks, $hasil['rataRata']);
        }

        return view('ahli.kriteria.matriks', compact(
            'kriterias',
            'matriks',
            'lengkap',
            'hasil',
            'konsistensi'
        ));
    }

    /**
     * Simpan matriks — HANYA pasangan i < j (upper triangle).
     * Kebalikan TIDAK disimpan ke DB agar nilai asli tidak berubah.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matriks'     => 'required|array',
            'matriks.*.*' => 'required|numeric|min:0.0001',
        ]);

        $kriterias = Kriteria::orderBy('id')->get();
        $ids       = $kriterias->pluck('id')->toArray();

        // Hapus dulu semua data lama agar tidak ada konflik
        PerbadinganKriteria::whereIn('kriteria_id_1', $ids)
            ->whereIn('kriteria_id_2', $ids)
            ->delete();

        // Simpan hanya i < j dari input form
        foreach ($request->matriks as $id1 => $cols) {
            foreach ($cols as $id2 => $nilai) {
                if (!in_array((int)$id1, $ids) || !in_array((int)$id2, $ids)) {
                    continue;
                }

                PerbadinganKriteria::create([
                    'kriteria_id_1' => $id1,
                    'kriteria_id_2' => $id2,
                    'nilai'         => (float) $nilai,
                ]);
            }
        }

        // Hitung dan simpan bobot ke tabel kriterias
        $matriks = $this->bangunMatriks($kriterias, $ids);
        $lengkap  = $this->cekLengkap($ids, $matriks);

        if ($lengkap) {
            $hasil = $this->hitungNormalisasi($ids, $matriks);
            foreach ($kriterias as $k) {
                $k->bobot = round($hasil['rataRata'][$k->id], 4);
                $k->save();
            }
        }

        return redirect()->route('kriteria.matriks.index')
            ->with('success', 'Matriks dan bobot kriteria berhasil disimpan.');
    }

    // ----------------------------------------------------------------
    // HELPER: bangun array matriks penuh dari DB
    // Hanya i < j yang ada di DB; i > j dihitung sebagai 1/nilai
    // ----------------------------------------------------------------
    private function bangunMatriks($kriterias, array $ids): array
    {
        $matriks = [];

        // Diagonal = 1
        foreach ($ids as $id) {
            $matriks[$id][$id] = 1;
        }

        // Ambil semua record dari DB (hanya i < j yang tersimpan)
        $pasangan = PerbadinganKriteria::whereIn('kriteria_id_1', $ids)
            ->whereIn('kriteria_id_2', $ids)
            ->get();

        foreach ($pasangan as $p) {
            $id1   = $p->kriteria_id_1;
            $id2   = $p->kriteria_id_2;
            $nilai = (float) $p->nilai;

            // Nilai asli (i < j)
            $matriks[$id1][$id2] = $nilai;

            // Kebalikan dihitung di memory — TIDAK ke DB
            if ($nilai != 0) {
                $matriks[$id2][$id1] = round(1 / $nilai, 4);
            }
        }

        return $matriks;
    }

    // ----------------------------------------------------------------
    // HELPER: cek apakah semua pasangan i < j sudah terisi
    // ----------------------------------------------------------------
    private function cekLengkap(array $ids, array $matriks): bool
    {
        $n = count($ids);
        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                if (empty($matriks[$ids[$i]][$ids[$j]])) {
                    return false;
                }
            }
        }
        return true;
    }

    // ----------------------------------------------------------------
    // HELPER: normalisasi & bobot
    // ----------------------------------------------------------------
    private function hitungNormalisasi(array $ids, array $matriks): array
    {
        $n = count($ids);

        // Jumlah tiap kolom
        $jumlahKolom = [];
        foreach ($ids as $colId) {
            $jumlahKolom[$colId] = 0;
            foreach ($ids as $rowId) {
                $jumlahKolom[$colId] += $matriks[$rowId][$colId] ?? 0;
            }
        }

        // Normalisasi
        $normalisasi = [];
        foreach ($ids as $rowId) {
            foreach ($ids as $colId) {
                $normalisasi[$rowId][$colId] = $jumlahKolom[$colId] != 0
                    ? ($matriks[$rowId][$colId] ?? 0) / $jumlahKolom[$colId]
                    : 0;
            }
        }

        // Rata-rata baris = bobot
        $rataRata = [];
        foreach ($ids as $rowId) {
            $rataRata[$rowId] = array_sum($normalisasi[$rowId]) / $n;
        }

        return compact('normalisasi', 'rataRata', 'jumlahKolom');
    }

    // ----------------------------------------------------------------
    // HELPER: λ max, CI, CR
    // ----------------------------------------------------------------
    private function hitungKonsistensi(array $ids, array $matriks, array $bobot): array
    {
        $ri  = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $n   = count($ids);

        $weightedSum = [];
        foreach ($ids as $rowId) {
            $weightedSum[$rowId] = 0;
            foreach ($ids as $colId) {
                $weightedSum[$rowId] += ($matriks[$rowId][$colId] ?? 0) * $bobot[$colId];
            }
        }

        $lambdas = [];
        foreach ($ids as $id) {
            $lambdas[$id] = $bobot[$id] != 0
                ? $weightedSum[$id] / $bobot[$id]
                : 0;
        }

        $lambdaMax = array_sum($lambdas) / $n;
        $ci        = $n > 1 ? ($lambdaMax - $n) / ($n - 1) : 0;
        $ri_val    = $ri[$n] ?? 1.49;
        $cr        = $ri_val != 0 ? $ci / $ri_val : 0;

        return [
            'lambda_max' => $lambdaMax,
            'ci'         => $ci,
            'cr'         => $cr,
            'ri'         => $ri_val,
            'konsisten'  => $cr <= 0.1,
        ];
    }
}