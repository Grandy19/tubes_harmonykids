<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Instansi\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * =========================
     * LOGIN (MULTI ROLE - FIXED)
     * =========================
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        $user = Auth::user();

        /**
         * 🔥 REDIRECT ABSOLUT BERDASARKAN ROLE
         * (JANGAN PAKE route())
         */
        switch ($user->role) {
            case 'pengelola':
                return redirect()->to('/pengelola/dashboard');

            case 'admin':
                return redirect()->to('/admin/dashboard');

            case 'wali':
            default:
                return redirect()->to('/wali/home');
        }
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

        return redirect()->to('/');
    }

    /**
     * =========================
     * REGISTER WALI
     * =========================
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'role'     => 'wali',
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->to('/wali/home')
            ->with('success', 'Registrasi berhasil!');
    }

    /**
     * =========================
     * REGISTER PENGELOLA
     * (1 USER = 1 INSTANSI)
     * =========================
     */
    public function registerPengelola(Request $request)
    {
        $data = $request->validate([
            'nama_instansi' => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'telepon'       => 'required|string',
            'alamat'        => 'required|string',
            'password'      => 'required|min:6|confirmed',
        ]);

        DB::transaction(function () use ($data) {

            // 1️⃣ User Pengelola
            $user = User::create([
                'name'     => $data['nama_instansi'],
                'email'    => $data['email'],
                'phone'    => $data['telepon'],
                'role'     => 'pengelola',
                'password' => Hash::make($data['password']),
            ]);

            // 2️⃣ Instansi (ONE TO ONE)
            Instansi::create([
                'pengelola_id'      => $user->id,
                'nama'              => $data['nama_instansi'],
                'lokasi'            => $data['alamat'],
                'biaya_pendaftaran' => 0,
                'jam_operasional'   => '-',
                'telepon'           => $data['telepon'],
                'email'             => $data['email'],
                'status'            => 'pending',
            ]);
        });

        return redirect()->to('/pengelola/login')
            ->with('success', 'Registrasi pengelola berhasil. Silakan login.');
    }
}
