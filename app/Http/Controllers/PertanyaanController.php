<?php

namespace App\Http\Controllers;
use App\Models\Kriteria;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Exception;


class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $query = Pertanyaan::query();
        
        // Filter berdasarkan kriteria jika ada parameter
        if ($request->has('kriteria_id') && $request->kriteria_id != '') {
            $query->where('kriteria_id', $request->kriteria_id);
        }
        
        // Sort berdasarkan kriteria
        $query->with('kriteria')->orderBy('kriteria_id');
        
        $pertanyaans = $query->get();
        $kriterias = Kriteria::all();
        return view('admin.pertanyaan.pertanyaan', compact('pertanyaans','kriterias'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'kriteria_id' => 'required',
                'pertanyaan' => 'required',
            ]);
            Pertanyaan::create($request->all());
            return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil ditambahkan');
        }catch  (Exception $e){
            return redirect()->route('pertanyaan.index')->with('error', 'Pertanyaan gagal ditambahkan');
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        try{
            $request->validate([
                'kriteria_id' => 'required',
                'pertanyaan' => 'required',
            ]);

            $pertanyaan = Pertanyaan::find($pertanyaan->id);
            $pertanyaan->kriteria_id = $request->kriteria_id;
            $pertanyaan->pertanyaan = $request->pertanyaan;
            $pertanyaan->update();  
            return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil diupdate');
        }catch  (Exception $e){
            return redirect()->route('pertanyaan.index')->with('error', 'Pertanyaan gagal diupdate');
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Pertanyaan $pertanyaan)
    {
        try{
            Pertanyaan::destroy($pertanyaan->id);  
            return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil dihapus');
        }catch  (Exception $e){
            return redirect()->route('pertanyaan.index')->with('error', 'Pertanyaan gagal dihapus');
        }
    }
}
