<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        $user    = Auth::user();

        return view('user.profile.profile', compact('profile', 'user'));
    }

    // ── Simpan atau update profile ─────────────────────────
    // POST /profile  →  name: user.profile.store
    public function store(Request $request)
    {
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

        // updateOrCreate: update jika sudah ada, buat baru jika belum
        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
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
