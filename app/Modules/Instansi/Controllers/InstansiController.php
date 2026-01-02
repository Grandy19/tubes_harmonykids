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
            ->with(['profile', 'galleries', 'galleryUtama']);

        if ($request->filled('lokasi') && $request->lokasi !== 'Semua') {
            $query->where('lokasi', 'LIKE', '%' . $request->lokasi . '%');
        }

        if ($request->filled('jenis') && $request->jenis !== 'Semua') {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('keyword')) {
            $query->where('nama', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filled('bakat')) {
            $query->where('bakat', 'LIKE', '%' . $request->bakat . '%');
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'Harga Terendah'  => $query->orderBy('biaya_pendaftaran', 'asc'),
                'Harga Tertinggi'=> $query->orderBy('biaya_pendaftaran', 'desc'),
                default           => $query->orderBy('created_at', 'desc'),
            };
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return response()->json($query->get());
    }

    // =======================
    // DETAIL INSTANSI (WALI)
    // =======================
    public function show($id)
    {
        $instansi = Instansi::where('status', 'approved')
            ->with([
                'profile',
                'user',
                'galleryUtama',
                'galleryProfil',
                'galleryFasilitas',
                'gallerySDM'
            ])
            ->findOrFail($id);

        return view('wali.detail.index', compact('instansi'));
    }

    // =======================
    // CREATE INSTANSI
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

        $instansi = DB::transaction(function () use ($request, $validated) {

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
            'data'    => $instansi
        ], 201);
    }

    // =======================
    // UPLOAD GALERI (API / ASYNC)
    // =======================
    public function uploadGallery(Request $request)
    {
        $request->validate([
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category' => 'required|in:utama,profil,fasilitas,sdm',
        ]);

        // Pastikan hanya pengelola instansi sendiri
        $instansi = Instansi::where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        // FOTO UTAMA → SINGLE
        if ($request->category === 'utama') {
            InstansiGallery::where('instansi_id', $instansi->id)
                ->where('category', 'utama')
                ->delete();
        }

        $path = $request->file('image')->store('instansi', 'public');

        $gallery = InstansiGallery::create([
            'instansi_id' => $instansi->id,
            'image_path'  => $path,
            'category'    => $request->category,
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => $gallery
        ], 201);
    }
}
