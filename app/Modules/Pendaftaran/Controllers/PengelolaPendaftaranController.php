<?php

namespace App\Modules\Pendaftaran\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pendaftaran\Models\Pendaftaran;
use App\Modules\Instansi\Models\Instansi;
use Illuminate\Http\Request;

class PengelolaPendaftaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | API (JANGAN DIUBAH)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        return Pendaftaran::with('wali')
            ->where('instansi_id', $instansi->id)
            ->latest()
            ->get();
    }

    public function show(Request $request, $id)
    {
        return $this->getPendaftaran($request, $id);
    }

    public function verify(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaran($request, $id);
        $pendaftaran->update(['status' => 'verified']);

        return response()->json([
            'message' => 'Pembayaran diverifikasi'
        ]);
    }

    public function accept(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaran($request, $id);
        $pendaftaran->update(['status' => 'accepted']);

        return response()->json([
            'message' => 'Pendaftaran diterima'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaran($request, $id);
        $pendaftaran->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Pendaftaran ditolak'
        ]);
    }

    private function getPendaftaran(Request $request, $id)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        return Pendaftaran::where('id', $id)
            ->where('instansi_id', $instansi->id)
            ->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | WEB (BLADE)
    |--------------------------------------------------------------------------
    */

    public function page(Request $request)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        $pendaftaran = Pendaftaran::with('wali')
            ->where('instansi_id', $instansi->id)
            ->latest()
            ->get();

        return view('pengelola.pendaftaran.index', compact('pendaftaran'));
    }

    public function pageDetail(Request $request, $id)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        $pendaftaran = Pendaftaran::with('wali')
            ->where('instansi_id', $instansi->id)
            ->findOrFail($id);

        return view('pengelola.pendaftaran.show', compact('pendaftaran'));
    }

    /*
    |--------------------------------------------------------------------------
    | WEB ACTION (REDIRECT, BUKAN JSON)
    |--------------------------------------------------------------------------
    */

    public function verifyWeb(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaran($request, $id);
        $pendaftaran->update(['status' => 'verified']);

        return redirect()
            ->route('pengelola.pendaftaran.show', $id)
            ->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function acceptWeb(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaran($request, $id);
        $pendaftaran->update(['status' => 'accepted']);

        return redirect()
            ->route('pengelola.pendaftaran.index')
            ->with('success', 'Pendaftaran diterima');
    }

    public function rejectWeb(Request $request, $id)
    {
        $pendaftaran = $this->getPendaftaran($request, $id);
        $pendaftaran->update(['status' => 'rejected']);

        return redirect()
            ->route('pengelola.pendaftaran.index')
            ->with('success', 'Pendaftaran ditolak');
    }
}
