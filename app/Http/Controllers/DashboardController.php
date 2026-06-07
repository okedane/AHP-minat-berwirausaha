<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pertanyaan;
use App\Models\KlasifikasiPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_kriteria' => Kriteria::count(),
            'total_pertanyaan' => Pertanyaan::count(),
            'klasifikasi' => KlasifikasiPenilaian::count(),
            'total_user' => User::where('role', 'user')->count(),
        ];

        return view('ahli.dashboard.index', $stats);
    }

    public function admin()
    {
        $stats = [
            'total_admin' => User::where('role', 'admin')->count(),
            'total_user' => User::where('role', 'user')->count(),
        ];

        return view('admin.dashboard.index', $stats);
    }


    public function showChangePassword()
    {
        return view('admin.change_password.index');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();
        assert($user instanceof User);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama salah');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui');
    }
}
