<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller; // Pastikan extend Controller bawaan Laravel
use App\Models\User;
use App\Modules\Instansi\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Wajib ada buat Session Login

class AuthController extends Controller
{
    /**
     * =========================
     * LOGIN (WEB SESSION)
     * =========================
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Coba Login & Buat Session
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Security: Cegah Session Fixation

            $user = Auth::user();

            // 2. Arahkan User Sesuai Role
            if ($user->role === 'wali') {
                // Pastikan route 'wali.home' ada di web.php
                return redirect()->route('wali.home'); 
            } elseif ($user->role === 'pengelola') {
                // Pastikan route dashboard pengelola ada
                return redirect()->route('pengelola.dashboard'); 
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Default fallback
            return redirect('/');
        }

        // 3. Kalau Gagal Login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * =========================
     * LOGOUT
     * =========================
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('wali.login');
    }

    /**
     * =========================
     * REGISTER WALI ONLY
     * =========================
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'role' => 'wali',
            'password' => Hash::make($data['password']),
        ]);

        // UX: Langsung login otomatis setelah daftar
        Auth::login($user);

        return redirect()->route('wali.home')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    /**
     * =========================
     * REGISTER PENGELOLA
     * =========================
     */
    public function registerPengelola(Request $request)
    {
        $data = $request->validate([
            'nama_instansi' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|string',
            'alamat' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::transaction(function () use ($data) {
            // 1. Buat user pengelola
            $user = User::create([
                'name' => $data['nama_instansi'],
                'email' => $data['email'],
                'phone' => $data['telepon'],
                'role' => 'pengelola',
                'password' => Hash::make($data['password']),
            ]);

            // 2. Auto-create instansi
            Instansi::create([
                'pengelola_id' => $user->id,
                'nama' => $data['nama_instansi'],
                'lokasi' => $data['alamat'],
                'biaya_pendaftaran' => 0,
                'jam_operasional' => '-',
                'telepon' => $data['telepon'],
                'email' => $data['email'],
                'status' => 'pending',
            ]);
        });

        // UX: Redirect ke login karena mungkin butuh approval admin dulu (tergantung logika lu)
        // Kalau mau auto login, pake Auth::login($user) kayak method register di atas.
        return redirect()->route('wali.login')->with('success', 'Registrasi Pengelola berhasil. Silakan login.');
    }
}