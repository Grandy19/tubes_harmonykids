<?php

namespace App\Modules\Instansi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Modules\Instansi\Models\Like; // Sesuaikan model Like Anda

class LikedController extends Controller
{
    public function index()
    {
        // LOGIKA: Ambil data instansi yang disukai oleh user yang sedang login
        
        // Contoh Data Dummy (Ganti ini dengan query database asli Anda nanti)
        $likedInstansis = [
            (object) [
                'id' => 1,
                'nama' => 'TK Ceria Bandung',
                'lokasi' => 'Bandung',
                'image' => 'public/instansi/tk1.jpg', 
                'rating' => 5.0,
                'biaya_pendaftaran' => 1200000,
                'label' => 'Terpopuler'
            ],
             (object) [
                'id' => 2,
                'nama' => 'Daycare Bintang Kecil',
                'lokasi' => 'Jakarta',
                'image' => null, 
                'rating' => 4.8,
                'biaya_pendaftaran' => 900000,
                'label' => 'Pilihan'
            ],
        ];

        // Contoh query asli (jika sudah ada relasi):
        // $likedInstansis = auth()->user()->likedInstansis()->get();

        return view('wali.liked.index', compact('likedInstansis'));
    }
}