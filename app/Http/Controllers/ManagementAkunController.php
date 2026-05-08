<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ManagementAkunController extends Controller
{
    public function admin() {
        $admin = User::where('role', 'admin')->get();
        return view('admin.akun.admin', compact('admin'));
    }

    public function user() {
        $user = User::where('role', 'user')->get();
        return view('admin.akun.user', compact('user'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'required|in:admin,user',
            ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
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
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update user.');
        }
    }


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }
}
