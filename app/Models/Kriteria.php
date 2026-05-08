<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'bobot',
    ];

    //PerbadinganKriteria

     public function perbandinganKriteria1()
    {
        return $this->hasMany(PerbadinganKriteria::class, 'kriteria_id_1');
    }

    public function perbandinganKriteria2()
    {
        return $this->hasMany(PerbadinganKriteria::class, 'kriteria_id_2');
    } 

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

}   