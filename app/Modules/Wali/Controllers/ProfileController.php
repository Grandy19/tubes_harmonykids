<?php

namespace App\Modules\Wali\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // Helper function buat Mode Demo (Biar gak null saat testing)
    private function getTargetUser()
    {
        // Prioritas 1: User yang login
        if (Auth::check()) {
            return Auth::user();
        }
        
        // Prioritas 2 (DEMO MODE): Ambil user pertama di database
        // PENTING: Pastikan di tabel users lu ADA isinya minimal 1
        $user = User::first();
        
        if (!$user) {
            dd("DATABASE KOSONG. Isi dulu tabel users minimal 1 data biar mode demo jalan.");
        }

        return $user;
    }

    public function edit()
    {
        $user = $this->getTargetUser(); // Atau logic user Anda
        
        // Arahkan ke file index di dalam folder edit
        return view('wali.edit.index', compact('user')); 
    }

    public function update(Request $request)
    {
        $currentUser = $this->getTargetUser();
        $user = User::find($currentUser->id); 

        // 1. Validasi Input
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'no_telepon'    => 'nullable|string', // Sesuai name="" di form
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'foto_profil'   => 'nullable|image|max:2048', // Max 2MB
            'pekerjaan'     => 'nullable|string',
            'hubungan_dengan_anak' => 'nullable|string',
            'alamat'        => 'nullable|string',
        ]);

        // 2. Logic Simpan Foto (SUDAH DIPERBAIKI)
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada di storage (biar gak numpuk sampah file)
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Simpan foto baru ke folder 'uploads/profil' di disk public
            $path = $request->file('foto_profil')->store('uploads/profil', 'public');
            $user->foto_profil = $path;
        }

        // 3. Update Data Teks
        $user->name = $request->name;
        $user->email = $request->email;
        
        // MAPPING: Database 'phone' diisi dari Input 'no_telepon'
        $user->phone = $request->no_telepon; 

        // Field tambahan
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->pekerjaan = $request->pekerjaan;
        $user->hubungan_dengan_anak = $request->hubungan_dengan_anak;
        $user->alamat = $request->alamat;
        
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}