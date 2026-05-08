<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function kuesioner()
    {
        return view('user.kuesioner.kuesioner');
    }

    public function hasil()
    {
        return view('user.hasil.hasil');
    }

    public function rekap()
    {
        return view('user.rekap.rekap');
    }
}
