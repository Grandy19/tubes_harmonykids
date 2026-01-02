<?php

namespace App\Modules\Wali\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pendaftaran\Models\Pendaftaran;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $notifikasi = Pendaftaran::with('instansi')
            ->where('wali_id', $request->user()->id)
            ->latest()
            ->get();

        return view('wali.notifikasi.index', compact('notifikasi'));
    }
}
