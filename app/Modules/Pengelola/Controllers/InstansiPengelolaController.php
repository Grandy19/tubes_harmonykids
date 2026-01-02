<?php

namespace App\Modules\Pengelola\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Instansi\Models\Instansi;
use App\Modules\Instansi\Models\InstansiProfile;
use App\Modules\Instansi\Models\InstansiGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstansiPengelolaController extends Controller
{
    /**
     * TAMPILKAN FORM EDIT
     */
    public function edit(Request $request)
    {
        $instansi = Instansi::with('profile')
            ->where('pengelola_id', $request->user()->id)
            ->firstOrFail();

        return view('pengelola.instansi.edit', compact('instansi'));
    }

    /**
     * SIMPAN PERUBAHAN DATA INSTANSI
     */
public function update(Request $request)
{
    $instansi = Instansi::where('pengelola_id', $request->user()->id)
        ->firstOrFail();

    $validated = $request->validate([
        'jenis'                => 'required|in:TK/PG,Daycare',
        'lokasi'               => 'required|string',
        'biaya_pendaftaran'    => 'required|integer|min:0',
        'jenis_pembayaran'     => 'required|in:BCA,BNI,BRI',
        'jam_operasional'      => 'required|string',
        'telepon'              => 'required|string',
        'email'                => 'required|email',
        'sekilas_tentang_kami' => 'nullable|string',
        'program_pembelajaran' => 'nullable|string',

        'gallery.utama'        => 'nullable|image|max:2048',
        'gallery.profil'       => 'sometimes|array|max:2',
        'gallery.profil.*'     => 'image|max:2048',
        'gallery.fasilitas'    => 'sometimes|array|max:4',
        'gallery.fasilitas.*'  => 'image|max:2048',
        'gallery.sdm'          => 'sometimes|array|max:4',
        'gallery.sdm.*'        => 'image|max:2048',
    ]);

    DB::transaction(function () use ($request, $instansi, $validated) {

        $instansi->update([
            'jenis'             => $validated['jenis'],
            'lokasi'            => $validated['lokasi'],
            'biaya_pendaftaran' => $validated['biaya_pendaftaran'],
            'jenis_pembayaran'  => $validated['jenis_pembayaran'], 
            'jam_operasional'   => $validated['jam_operasional'],
            'telepon'           => $validated['telepon'],
            'email'             => $validated['email'],
        ]);

        InstansiProfile::updateOrCreate(
            ['instansi_id' => $instansi->id],
            [
                'sekilas_tentang_kami' => $validated['sekilas_tentang_kami'] ?? null,
                'program_pembelajaran'=> $validated['program_pembelajaran'] ?? null,
            ]
        );

        // 🔥 INI KUNCI PERBAIKAN
        if ($request->has('gallery')) {
            foreach ($request->file('gallery') as $category => $files) {

                // FOTO UTAMA
                if ($category === 'utama' && $files) {
                    InstansiGallery::where('instansi_id', $instansi->id)
                        ->where('category', 'utama')
                        ->delete();

                    InstansiGallery::create([
                        'instansi_id' => $instansi->id,
                        'image_path'  => $files->store('instansi', 'public'),
                        'category'    => 'utama',
                    ]);
                    continue;
                }

                // GALERI MULTI
                if (is_array($files)) {
                    InstansiGallery::where('instansi_id', $instansi->id)
                        ->where('category', $category)
                        ->delete();

                    foreach ($files as $file) {
                        InstansiGallery::create([
                            'instansi_id' => $instansi->id,
                            'image_path'  => $file->store('instansi', 'public'),
                            'category'    => $category,
                        ]);
                    }
                }
            }
        }
    });

    return redirect()
        ->route('pengelola.instansi.edit')
        ->with('success', 'Profil instansi & galeri berhasil diperbarui');
    }
}
