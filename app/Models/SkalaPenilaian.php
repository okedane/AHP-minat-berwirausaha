<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkalaPenilaian extends Model
{
    protected $fillable = [
        'pertanyaan_id',
        'user_id',
        'label',
        'skor',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
