<?php

namespace App\Modules\Wali\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;              
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;      

class SettingsController extends Controller
{
    // Menampilkan Halaman Setting
    public function index()
    {
        $user = Auth::user();
        return view('wali.settings.index', compact('user'));
    }

    // Proses Update Password (AJAX)
    public function updatePassword(Request $request)
    {
        // Validasi Input
        $request->validate([
            'password' => 'required|min:6|confirmed', 
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