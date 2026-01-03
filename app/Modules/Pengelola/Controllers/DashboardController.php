<?php

namespace App\Modules\Pengelola\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Instansi\Models\Instansi;
use App\Modules\Pendaftaran\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil instansi milik pengelola (1 pengelola = 1 instansi)
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        // =====================
        // STATISTIK PENDAFTARAN
        // =====================
        $total = Pendaftaran::where('instansi_id', $instansi->id)->count();

        $pending = Pendaftaran::where('instansi_id', $instansi->id)
            ->where('status', 'pending')
            ->count();

        $accepted = Pendaftaran::where('instansi_id', $instansi->id)
            ->where('status', 'accepted')
            ->count();

        $rejected = Pendaftaran::where('instansi_id', $instansi->id)
            ->where('status', 'rejected')
            ->count();

        // =====================
        // RESPONSE (API STYLE)
        // =====================
        return response()->json([
            'instansi' => [
                'id'     => $instansi->id,
                'nama'   => $instansi->nama,
                'status' => $instansi->status, 
            ],
            'pendaftaran' => [
                'total'    => $total,
                'pending'  => $pending,
                'accepted' => $accepted,
                'rejected' => $rejected,
            ],
        ]);
    }
}
