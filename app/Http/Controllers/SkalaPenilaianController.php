<?php

namespace App\Http\Controllers;

use App\Models\SkalaPenilaian;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;  

class SkalaPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $skalaPenilaians = SkalaPenilaian::where('pertanyaan_id', $id)->get();
        return view('admin.skala-penilaian.jawab', compact('skalaPenilaians', 'pertanyaan'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'pertanyaan' => 'required',
                'label.*' => 'required',
                'skor.*' => 'required',
            ]);
            SkalaPenilaian::create([
                'pertanyaan_id' => $request->pertanyaan_id,
                'label' => $request->label,
                'skor' => $request->skor,
            ]);
            return redirect()->back()->with('success', 'Skala penilaian berhasil ditambahkan!');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Gagal menambahkan skala penilaian! ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkalaPenilaian $skalaPenilaian)
    {
        try{
            $validator = Validator::make($request->all(), [
                'pertanyaan' => 'required',
                'label.*' => 'required',
                'skor.*' => 'required',
            ]);
            SkalaPenilaian::updateOrCreate(
                [
                    'pertanyaan_id' => $request->pertanyaan_id,
                ],
                [
                    'label' => $request->label,
                    'skor' => $request->skor,
                ]
            );
            return redirect()->back()->with('success', 'Skala penilaian berhasil diupdate!');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Gagal update skala penilaian! ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SkalaPenilaian $skalaPenilaian)
    {
       try{
           $validator = Validator::make($request->all(), [
               'pertanyaan' => 'required',
           ]);
           SkalaPenilaian::destroy(
               [
                   'pertanyaan_id' => $request->pertanyaan_id,
               ]
           );
           return redirect()->back()->with('success', 'Skala penilaian berhasil dihapus!');
       }catch(Exception $e){
           return redirect()->back()->with('error', 'Gagal menghapus skala penilaian! ' . $e->getMessage());
       }   
    }
}
