<?php

namespace App\Modules\Pendaftaran\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Import Model Pendaftaran
use App\Modules\Pendaftaran\Models\Pendaftaran;
// Import Model Instansi (WAJIB ADA agar function create jalan)
use App\Modules\Instansi\Models\Instansi; 

class PendaftaranController extends Controller
{
    // =========================================================================
    // BAGIAN WALI (ORANG TUA)
    // =========================================================================

    /**
     * MENAMPILKAN HALAMAN FORMULIR 
     */
    public function create($instansi_id)
    {
        // Cari data instansi berdasarkan ID, kalau ga ketemu error 404
        $instansi = Instansi::findOrFail($instansi_id);
        
        // Tampilkan view form pendaftaran dengan membawa data instansi
        return view('wali.daftar.index', compact('instansi'));
    }

    /**
     * 2. MEMPROSES DATA PENDAFTARAN 
     */
    public function store(Request $request)
    {
        // A. Validasi Input sesuai form
        $data = $request->validate([
            'instansi_id'       => 'required|exists:instansis,id',
            'nama_anak'         => 'required|string',
            'ttl'               => 'required|date',
            'jenis_kelamin'     => 'required|in:L,P',
            'alamat'            => 'required|string',
            'riwayat_kesehatan' => 'nullable|string',
            'kewarganegaraan'   => 'required|string',
            'agama'             => 'nullable|string', 
            'bukti_pembayaran'  => 'required|image|max:2048', 
        ]);

        // Upload File Bukti Pembayaran
        $path = $request->file('bukti_pembayaran')
            ->store('bukti-pembayaran', 'public');

        // Simpan ke Database
        Pendaftaran::create([
            'instansi_id'       => $data['instansi_id'],
            'wali_id'           => $request->user()->id, 
            'nama_anak'         => $data['nama_anak'],
            'ttl'               => $data['ttl'],
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'alamat'            => $data['alamat'],
            'riwayat_kesehatan' => $data['riwayat_kesehatan'],
            'kewarganegaraan'   => $data['kewarganegaraan'],
            'bukti_pembayaran'  => $path,
            'status'            => 'pending', 
        ]);

        // Redirect kembali ke Home dengan pesan sukses
        return redirect()->back()->with(
            'success',
            'Pendaftaran berhasil dikirim! Mohon tunggu konfirmasi admin.'
        );
    }
}