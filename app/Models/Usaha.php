<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $fillable = ['nama_usaha', 'klasifikasi_penilaian_id'];

    public function klasifikasiPenilaian()
    {
        return $this->belongsTo(KlasifikasiPenilaian::class);
    }
}
