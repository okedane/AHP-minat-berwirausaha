<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $profile = Profile::where('user_id', $user->id)->first();

        return view('user.profile.profile', compact('profile', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('toast_error', 'Anda harus login terlebih dahulu.');
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'prodi'        => 'required|string|max:100',
            'fakultas'     => 'nullable|string|max:100',
            'angkatan'     => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'prodi.required'        => 'Program studi wajib diisi.',
            'angkatan.digits'       => 'Angkatan harus berupa tahun 4 digit.',
            'angkatan.min'          => 'Angkatan tidak valid.',
        ]);

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => $request->nama_lengkap,
                'prodi'        => $request->prodi,
                'fakultas'     => $request->fakultas,
                'angkatan'     => $request->angkatan,
            ]
        );

        return redirect()
            ->route('user.profile')
            ->with('toast_success', 'Profil berhasil disimpan!');
    }
}
