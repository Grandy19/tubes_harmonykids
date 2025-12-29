<?php

namespace App\Modules\Instansi\Controllers;

use App\Modules\Instansi\Models\Instansi;
use App\Modules\Instansi\Models\InstansiProfile;
use App\Modules\Instansi\Models\InstansiGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class InstansiController
{
    // =======================
    // WALI - LIST INSTANSI
    // =======================
    public function index(Request $request)
    {
        $query = Instansi::where('status', 'approved');

        // FILTER LOKASI
        if ($request->filled('lokasi')) {
            $query->where('lokasi', $request->lokasi);
        }

        // FILTER JENIS
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // SORTING
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'harga_asc':
                    $query->orderBy('biaya_pendaftaran', 'asc');
                    break;

                case 'harga_desc':
                    $query->orderBy('biaya_pendaftaran', 'desc');
                    break;

                case 'rekomendasi':
                    // SEMENTARA: rekomendasi = yang paling lengkap datanya
                    $query->withCount('galleries')
                        ->orderBy('galleries_count', 'desc');
                    break;
            }
        }

        return $query->with(['profile', 'galleries'])->get();
    }

    // =======================
    // WALI - DETAIL INSTANSI
    // =======================
    public function show($id)
    {
        return Instansi::where('id', $id)
            ->where('status', 'approved')
            ->with(['profile', 'galleries'])
            ->firstOrFail();
    }

    // =======================
    // PENGELOLA - CREATE
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required|in:TK/PG,Daycare',
            'lokasi' => 'required',
            'biaya_pendaftaran' => 'required|integer',
            'jam_operasional' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
        ]);

        // Cegah pengelola bikin lebih dari 1 instansi
        if (Instansi::where('pengelola_id', $request->user()->id)->exists()) {
            return response()->json([
                'message' => 'Pengelola hanya boleh memiliki satu instansi'
            ], 403);
        }

        $instansi = Instansi::create([
            'pengelola_id' => $request->user()->id,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'biaya_pendaftaran' => $request->biaya_pendaftaran,
            'jam_operasional' => $request->jam_operasional,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);

        // Auto-create profile kosong
        InstansiProfile::create([
            'instansi_id' => $instansi->id,
        ]);

        return response()->json($instansi, 201);
    }

    // =======================
    // PENGELOLA - UPDATE
    // =======================
    public function update(Request $request)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        $instansi->update($request->only([
            'nama',
            'jenis',
            'lokasi',
            'biaya_pendaftaran',
            'jam_operasional',
            'telepon',
            'email',
        ]));

        return response()->json($instansi);
    }

    public function uploadGallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'category' => 'required|in:galeri,ruangan,sdm,layanan',
        ]);

        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        // VALIDASI MAKS GALERI 2
        if ($request->category === 'galeri') {
            $count = InstansiGallery::where('instansi_id', $instansi->id)
                ->where('category', 'galeri')
                ->count();

            if ($count >= 2) {
                return response()->json([
                    'message' => 'Galeri maksimal 2 gambar'
                ], 422);
            }
        }

        $path = $request->file('image')->store('instansi', 'public');

        $gallery = InstansiGallery::create([
            'instansi_id' => $instansi->id,
            'image_path' => $path,
            'category' => $request->category,
        ]);

        return response()->json($gallery, 201);
    }
}
