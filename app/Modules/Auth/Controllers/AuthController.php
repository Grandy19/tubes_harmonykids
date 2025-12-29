<?php

namespace App\Modules\Auth\Controllers;

use App\Models\User;
use App\Modules\Instansi\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController
{
    /**
     * =========================
     * REGISTER WALI ONLY
     * =========================
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'role' => 'wali', // ⛔ WAJIB wali
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'message' => 'Registrasi wali berhasil',
            'user' => $user,
        ], 201);
    }

    /**
     * =========================
     * LOGIN (SEMUA ROLE)
     * =========================
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
    ]
        ]);
    }

    /**
     * =========================
     * REGISTER PENGELOLA
     * AUTO CREATE INSTANSI
     * ONE TO ONE
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

            // 2. Auto-create instansi (ONE TO ONE)
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

        return response()->json([
            'message' => 'Registrasi pengelola berhasil, instansi otomatis dibuat',
        ], 201);
    }
}
