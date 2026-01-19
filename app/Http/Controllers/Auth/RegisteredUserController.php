<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider; // Tambahkan ini jika pakai default
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // PERBAIKAN: Tambahkan 'in:user,admin' agar user tidak bisa input role aneh-aneh
            'role' => ['required', 'string', 'in:user,admin'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, 
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // LOGIKA REDIRECT (PENGARAHAN HALAMAN)
        // 1. Jika Role ADMIN -> Ke Dashboard Admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); 
        } 
        
        // 2. Jika Role USER/PENGUNJUNG -> Ke Landing Page (Halaman Depan)
        return redirect()->route('landing');
    }
}