<?php

namespace App\Modules\Wali\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;              // PENTING: Untuk menangkap input
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;      // PENTING: Untuk enkripsi password

class SettingsController extends Controller
{
    // 1. Menampilkan Halaman Setting
    public function index()
    {
        $user = Auth::user();
        return view('wali.settings.index', compact('user'));
    }

    // 2. Proses Update Password (AJAX)
    public function updatePassword(Request $request)
    {
        // Validasi Input
        $request->validate([
            'password' => 'required|min:6|confirmed', // 'confirmed' mengecek input 'password_confirmation'
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update Password ke Database
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        // Kirim respon JSON ke Javascript
        return response()->json([
            'status' => 'success', 
            'message' => 'Password berhasil diperbarui!'
        ]);
    }
}