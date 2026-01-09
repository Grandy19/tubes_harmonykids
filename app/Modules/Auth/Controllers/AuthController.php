<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Instansi\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Tambahan penting buat API

class AuthController extends Controller
{
    /**
     * =========================
     * LOGIN (HYBRID: WEB & API)
     * =========================
     */
    public function login(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            // Jika request dari Flutter/API, return JSON error
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors'  => $validator->errors()
                ], 422);
            }
            // Jika dari Web, return redirect
            return back()->withErrors($validator)->onlyInput('email');
        }

        $credentials = $request->only('email', 'password');

        // 2. Cek Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // === LOGIKA API (FLUTTER) ===
            if ($request->wantsJson() || $request->is('api/*')) {
                // Buat token (opsional, tapi bagus buat auth state)
                // $token = $user->createToken('mobile-app')->plainTextToken; 
                
                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil',
                    'data'    => [
                        'id'    => $user->id,
                        'name'  => $user->name,
                        'email' => $user->email,
                        'role'  => $user->role,
                    ],
                    // 'token' => $token // Uncomment kalau pakai Sanctum
                ], 200);
            }

            // === LOGIKA WEB (ORIGINAL) ===
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

        // 3. Login Gagal
        // Jika request dari Flutter/API
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah',
            ], 401);
        }

        // Jika dari Web
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

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['success' => true, 'message' => 'Logout berhasil']);
        }

        return redirect()->to('/');
    }

    /**
     * =========================
     * REGISTER WALI
     * =========================
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['success'=>false, 'errors'=>$validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'     => $request->all()['name'],
            'email'    => $request->all()['email'],
            'phone'    => $request->all()['phone'] ?? null,
            'role'     => 'wali',
            'password' => Hash::make($request->all()['password']),
        ]);

        Auth::login($user);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true, 
                'message' => 'Registrasi Berhasil', 
                'data' => $user
            ], 201);
        }

        return redirect()->to('/wali/home')->with('success', 'Registrasi berhasil!');
    }

    /**
     * =========================
     * REGISTER PENGELOLA
     * =========================
     */
    public function registerPengelola(Request $request)
    {
        // Saya persingkat bagian ini karena jarang dipakai login mobile, 
        // tapi logicnya sama: Cek $request->wantsJson() kalau mau dibuat support API.
        
        // ... (Kode original tetap berjalan untuk Web)
        
        $data = $request->validate([
            'nama_instansi' => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'telepon'       => 'required|string',
            'alamat'        => 'required|string',
            'password'      => 'required|min:6|confirmed',
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name'     => $data['nama_instansi'],
                'email'    => $data['email'],
                'phone'    => $data['telepon'],
                'role'     => 'pengelola',
                'password' => Hash::make($data['password']),
            ]);

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

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['success' => true, 'message' => 'Registrasi Pengelola Berhasil'], 201);
        }

        return redirect()->to('/pengelola/login')
            ->with('success', 'Registrasi pengelola berhasil. Silakan login.');
    }
}