<?php

namespace App\Modules\Pendaftaran\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pendaftaran\Models\Pendaftaran;
use App\Modules\Instansi\Models\Instansi;
use Illuminate\Http\Request;

class PengelolaPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        return Pendaftaran::where('instansi_id', $instansi->id)->get();
    }

    public function approve(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaranMilikPengelola($request, $id);
        $pendaftaran->update(['status' => 'accepted']);

        return response()->json(['message' => 'Pendaftaran diterima']);
    }

    public function reject(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaranMilikPengelola($request, $id);
        $pendaftaran->update(['status' => 'rejected']);

        return response()->json(['message' => 'Pendaftaran ditolak']);
    }

    private function getPendaftaranMilikPengelola(Request $request, $id)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        return Pendaftaran::where('id', $id)
            ->where('instansi_id', $instansi->id)
            ->firstOrFail();
    }
}
