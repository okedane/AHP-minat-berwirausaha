<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilKuesioner extends Model
{
    protected $fillable = [
        'user_id',
        'klasifikasi_penilaian_id',
        'nilai_akhir',
        'nilai_per_kriteria',
        'jawaban_raw',
    ];
    
    // app/Models/HasilKuesioner.php
    public function klasifikasiPenilaian()
    {
        return $this->belongsTo(KlasifikasiPenilaian::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
