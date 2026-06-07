<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KlasifikasiPenilaian;
use App\Models\Usaha;

class UsahaController extends Controller
{
    public function index($id)
    {
        $klasifikasiPenilaian = KlasifikasiPenilaian::find($id);
        $usaha = Usaha::where('klasifikasi_penilaian_id', $id)->get();
        return view('ahli.usaha.usaha', compact('klasifikasiPenilaian', 'usaha'));
    }

    public function store(Request $request)
    {
        try {
            Usaha::create($request->all());
            return redirect()->back()->with('success', 'Usaha berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Usaha gagal ditambahkan: ' . $th->getMessage());
        }
    }

    public function update(Request $request, Usaha $usaha)
    {
        try {

            $usaha->update($request->all());

            return redirect()->back()->with('success', 'Usaha berhasil diupdate!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Usaha gagal diupdate: ' . $th->getMessage());
        }
    }

    public function destroy(Usaha $usaha)
    {
        try {
            if (!$usaha) {
                return redirect()->back()->with('error', 'Data tidak ditemukan!');
            }
            $usaha->delete();
            return redirect()->back()->with('success', 'Usaha berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Usaha gagal dihapus: ' . $th->getMessage());
        }
    }
}
