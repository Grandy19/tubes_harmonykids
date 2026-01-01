<?php

namespace App\Modules\Instansi\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Instansi\Models\Instansi;
use App\Modules\Instansi\Models\InstansiProfile;
use App\Modules\Instansi\Models\InstansiGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstansiController extends Controller
{
    // =======================
    // WALI - LIST INSTANSI (API)
    // =======================
    public function index(Request $request)
    {
        $query = Instansi::where('status', 'approved')
            ->with(['profile', 'galleries']);

        // 1. FILTER LOKASI
        if ($request->filled('lokasi') && $request->lokasi !== 'Semua') {
            $query->where('lokasi', 'LIKE', '%' . $request->lokasi . '%');
        }

        // 2. FILTER JENIS (PENTING: CEGAH STRING KOSONG)
        if (
            $request->filled('jenis') &&
            $request->jenis !== 'Semua' &&
            $request->jenis !== ''
        ) {
            $query->where('jenis', $request->jenis);
        }

        // 3. FILTER KEYWORD (FITUR LAIN, BIARKAN)
        if ($request->filled('keyword')) {
            $query->where('nama', 'LIKE', '%' . $request->keyword . '%');
        }

        // 4. FILTER BAKAT (HARMO TALENT - FINAL)
        if ($request->filled('bakat')) {
            $query->where('bakat', 'LIKE', '%' . $request->bakat . '%');
        }

        // 5. SORTING
        if ($request->filled('sort')) {
            match ($request->sort) {
                'Harga Terendah' => $query->orderBy('biaya_pendaftaran', 'asc'),
                'Harga Tertinggi'=> $query->orderBy('biaya_pendaftaran', 'desc'),
                default          => $query->orderBy('created_at', 'desc'),
            };
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return response()->json($query->get());
    }

    // =======================
    // DETAIL INSTANSI
    // =======================
    public function show($id)
    {
        $instansi = Instansi::where('status', 'approved')
            ->with(['profile', 'galleries', 'user'])
            ->findOrFail($id);

        return view('wali.detail.index', compact('instansi'));
    }

    // =======================
    // CREATE INSTANSI (API)
    // =======================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'jenis'             => 'required|in:TK/PG,Daycare',
            'lokasi'            => 'required|string',
            'biaya_pendaftaran' => 'required|integer|min:0',
            'jam_operasional'   => 'required|string',
            'telepon'           => 'required|string|max:20',
            'email'             => 'required|email|max:255',
        ]);

        if (Instansi::where('pengelola_id', $request->user()->id)->exists()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Anda sudah memiliki instansi terdaftar.'
            ], 403);
        }

        try {
            $result = DB::transaction(function () use ($request, $validated) {
                $instansi = Instansi::create(array_merge($validated, [
                    'pengelola_id' => $request->user()->id,
                    'status'       => 'pending'
                ]));

                InstansiProfile::create([
                    'instansi_id' => $instansi->id
                ]);

                return $instansi;
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Instansi berhasil didaftarkan',
                'data'    => $result
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal membuat instansi: ' . $e->getMessage()
            ], 500);
        }
    }

    // =======================
    // UPDATE INSTANSI
    // =======================
    public function update(Request $request)
    {
        $instansi = Instansi::where('pengelola_id', $request->user()->id)->first();

        if (!$instansi) {
            return response()->json(['message' => 'Instansi tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama'              => 'sometimes|required|string|max:255',
            'jenis'             => 'sometimes|required|in:TK/PG,Daycare',
            'lokasi'            => 'sometimes|required|string',
            'biaya_pendaftaran' => 'sometimes|required|integer|min:0',
            'jam_operasional'   => 'sometimes|required|string',
            'telepon'           => 'sometimes|required|string|max:20',
            'email'             => 'sometimes|required|email',
        ]);

        $instansi->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    // =======================
    // UPLOAD GALERI
    // =======================
    public function uploadGallery(Request $request)
    {
        $request->validate([
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category' => 'required|in:galeri,ruangan,sdm,layanan',
        ]);

        $instansi = Instansi::where('pengelola_id', $request->user()->id)->firstOrFail();

        if ($request->category === 'galeri') {
            $count = InstansiGallery::where('instansi_id', $instansi->id)
                ->where('category', 'galeri')
                ->count();

            if ($count >= 2) {
                return response()->json(['message' => 'Maksimal 2 foto utama'], 422);
            }
        }

        $path = $request->file('image')->store('instansi', 'public');

        $gallery = InstansiGallery::create([
            'instansi_id' => $instansi->id,
            'image_path'  => $path,
            'category'    => $request->category,
        ]);

        return response()->json(['status' => 'success', 'data' => $gallery], 201);
    }
}
