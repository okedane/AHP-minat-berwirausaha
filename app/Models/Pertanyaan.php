<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = [
        'kriteria_id',
        'pertanyaan',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function skalaPenilaians()
    {
        return $this->hasMany(SkalaPenilaian::class);
    }
}
