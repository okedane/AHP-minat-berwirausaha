<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KlasifikasiPenilaian;
use App\Models\Usaha;
use Illuminate\Support\Facades\Validator;

class KlasifikasiPenilaianController extends Controller
{
    public function index()
    {
        $klasifikasiPenilaians = KlasifikasiPenilaian::all();
        return view('admin.klasifikasi-penilaian.klasifikasi', compact('klasifikasiPenilaians'));
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required',
                'min' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'max' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'deskripsi' => 'nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            KlasifikasiPenilaian::create($request->all());
            return redirect()->back()->with('success', 'Skala penilaian berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Klasifikasi Penilaian gagal ditambahkan: ' . $th->getMessage());
        }
    }


    public function update(Request $request, KlasifikasiPenilaian $klasifikasiPenilaian){
        try {
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required',
                'min' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'max' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'deskripsi' => 'nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $klasifikasiPenilaian->update($request->all());
            return redirect()->back()->with('success', 'Klasifikasi Penilaian berhasil diupdate!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Klasifikasi Penilaian gagal diupdate: ' . $th->getMessage());
        }
    }

    public function destroy(KlasifikasiPenilaian $klasifikasiPenilaian){
        try {
            if (!$klasifikasiPenilaian) {
                return redirect()->back()->with('error', 'Data tidak ditemukan!');
            }
            
            $klasifikasiPenilaian->delete();
            return redirect()->back()->with('success', 'Klasifikasi Penilaian berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Klasifikasi Penilaian gagal dihapus: ' . $th->getMessage());
        }
    }
}
