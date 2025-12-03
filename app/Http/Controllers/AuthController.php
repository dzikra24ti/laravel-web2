<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $input = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Percobaan otentikasi
        if (Auth::attempt($input)) {
            // Login Berhasil
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Arahkan ke /dashboard (atau tujuan yang dimaksud)
        }

        // 3. Login Gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    // Halaman dashboard
    public function dashboard()
    {
        // Cek apakah user sudah login
        if (!session()->has('login_user')) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu!']);
        }

        $user = \App\Models\User::find(session('login_user'));
        return view('admin.dashboard', compact('user'));
    }

    public function logout(Request $request)
    {
        // 1. Hapus otentikasi
        Auth::logout();

        // 2. Invalidasi sesi
        $request->session()->invalidate();

        // 3. Regenerasi token CSRF
        $request->session()->regenerateToken();

        // 4. Arahkan ke halaman utama
        return redirect('/');
    }
}
