<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class ManagementAkunController extends Controller
{
    public function admin() {
        $admin = User::with('profile')->where('role', 'admin')->get();
        return view('admin.akun.admin', compact('admin'));
    }

    public function user() {
        $user = User::with('profile')->where('role', 'user')->get();
        return view('admin.akun.user', compact('user'));
    }

     public function ahli() {
        $ahli = User::with('profile')->where('role', 'ahli')->get();
        return view('admin.akun.ahli', compact('ahli'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'required|in:admin,user',
                'nama_lengkap' => 'nullable|string|max:255',
                'prodi' => 'nullable|string|max:255',
                'fakultas' => 'nullable|string|max:255',
                'angkatan' => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($request->filled('nama_lengkap') || $request->filled('prodi')) {
                Profile::create([
                    'user_id' => $user->id,
                    'nama_lengkap' => $request->nama_lengkap ?? $request->name,
                    'prodi' => $request->prodi,
                    'fakultas' => $request->fakultas,
                    'angkatan' => $request->angkatan,
                ]);
            }

            return redirect()->back()->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create user. ' . $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'role' => 'required|in:admin,user',
                'nama_lengkap' => 'nullable|string|max:255',
                'prodi' => 'nullable|string|max:255',
                'fakultas' => 'nullable|string|max:255',
                'angkatan' => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            // Update atau create profile
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $request->nama_lengkap ?? $request->name,
                    'prodi' => $request->prodi,
                    'fakultas' => $request->fakultas,
                    'angkatan' => $request->angkatan,
                ]
            );

            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update user. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            Profile::where('user_id', $id)->delete();
            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }
}
