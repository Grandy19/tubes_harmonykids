<?php

namespace App\Modules\Pendaftaran\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Pendaftaran\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    // WALI - DAFTAR ANAK
    public function store(Request $request)
    {
        $data = $request->validate([
            'instansi_id' => 'required|exists:instansis,id',
            'nama_anak' => 'required',
            'ttl' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'riwayat_kesehatan' => 'nullable',
            'kewarganegaraan' => 'required',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')
            ->store('bukti-pembayaran', 'public');

        $pendaftaran = Pendaftaran::create([
            ...$data,
            'wali_id' => $request->user()->id,
            'bukti_pembayaran' => $path,
            'status' => 'pending',
        ]);

        return response()->json($pendaftaran, 201);
    }

    // PENGELOLA - LIST PENDAFTARAN
    public function index(Request $request)
    {
        return response()->json([
            'login_user_id' => $request->user()->id,
            'pendaftaran' => Pendaftaran::whereHas('instansi', function ($q) use ($request) {
                $q->where('pengelola_id', $request->user()->id);
            })->get()
        ]);
    }

    // PENGELOLA - APPROVE
    public function approve($id, Request $request)
    {
        $pendaftaran = Pendaftaran::where('id', $id)
            ->whereHas('instansi', function ($q) use ($request) {
                $q->where('pengelola_id', $request->user()->id);
            })
            ->firstOrFail();

        $pendaftaran->update(['status' => 'approved']);

        return response()->json(['message' => 'Pendaftaran diterima']);
    }

    // PENGELOLA - REJECT
    public function reject($id, Request $request)
    {
        $pendaftaran = Pendaftaran::where('id', $id)
            ->whereHas('instansi', function ($q) use ($request) {
                $q->where('pengelola_id', $request->user()->id);
            })
            ->firstOrFail();

        $pendaftaran->update(['status' => 'rejected']);

        return response()->json(['message' => 'Pendaftaran ditolak']);
    }
}
