<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->withInput();
        }

        // Cek password menggunakan Hash::check
        if (Hash::check($request->password, $user->password)) {
            // Simpan sesi login
            session(['login_user' => $user->id]);

            // Arahkan ke dashboard
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['password' => 'Password salah'])->withInput();
        }
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
}
