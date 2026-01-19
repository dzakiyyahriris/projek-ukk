<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib
use Illuminate\Support\Facades\Hash; // Wajib untuk password

class UserProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     * Method ini yang dicari oleh error "undefined method index".
     */
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Tampilkan view 'user.profile' dan kirim data user
        // Pastikan nama view sesuai dengan folder: resources/views/user/profile.blade.php
        return view('user.profile', compact('user'));
    }

    /**
     * Memproses update data profil.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // 2. Update Data
        $user->name = $request->name;
        $user->email = $request->email;

        // 3. Cek Password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // 4. Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}