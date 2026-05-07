<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('created_at', 'asc')->get();
        return view('admin.kriteria.kriteria', compact('kriteria'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required',
            ]);

            $lastNumber = Kriteria::count() + 1;
            $validated['kode'] = 'C' . $lastNumber;

            kriteria::create($validated);
            return redirect()->back()->with('success', 'Kriteria berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Kriteria. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required',
            ]);

            $kriteria = kriteria::findOrFail($id);
            $kriteria->update($validated);

            return redirect()->back()->with('success', 'Kriteria berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui Kriteria. Silakan coba lagi.' . $th->getMessage());
        }
    }

    public function delete(Kriteria $id)
    {
        try {
            $deletedNumber = (int) str_replace('C', '', $id->kode);

            // Hapus data
            $id->delete();

            // Ambil semua data setelah kode yang dihapus
            $updateKode = Kriteria::whereRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED) > ?', [$deletedNumber])
                                             ->orderByRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED)')
                                             ->get();
            // Update ulang kode-kode setelahnya
            foreach ($updateKode as $item) {
                $currentNumber = (int) str_replace('C', '', $item->kode);
                $newNumber = $currentNumber - 1;
                $item->update(['kode' => 'C' . $newNumber]);
            }

            return redirect()->back()->with('success', 'Kriteria berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus Kriteria. Silakan coba lagi.');
        }
    }
}
