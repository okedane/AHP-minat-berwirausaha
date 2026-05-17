<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlasifikasiPenilaian extends Model
{
    protected $fillable = ['nama_kategori', 'nilai_min', 'nilai_max', 'deskripsi'];

    public function usahas()
    {
        return $this->hasMany(Usaha::class);
    }
}
