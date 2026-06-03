<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_kriteria' => Kriteria::count(),
            'total_pertanyaan' => Pertanyaan::count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_user' => User::where('role', 'user')->count(),
        ];

        return view('admin.dashboard.index', $stats);
    }   
}
