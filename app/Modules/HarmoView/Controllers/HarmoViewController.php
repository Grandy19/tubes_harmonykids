<?php

namespace App\Modules\HarmoView\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Instansi\Models\Instansi;

class HarmoViewController extends Controller
{
    public function compare(Request $request)
    {
        $request->validate([
            'ids' => 'required|string',
        ]);

        $ids = explode(',', $request->ids);

        if (count($ids) !== 2) {
            return response()->json([
                'message' => 'Harus memilih tepat 2 instansi'
            ], 422);
        }

        $instansis = \App\Modules\Instansi\Models\Instansi::whereIn('id', $ids)
            ->where('status', 'approved')
            ->with(['profile', 'galleries'])
            ->get();

        if ($instansis->count() !== 2) {
            return response()->json([
                'message' => 'Instansi tidak valid atau belum approved'
            ], 404);
        }

        return $instansis->map(function ($i) {

            // Hitung jumlah fasilitas
            $jumlahFasilitas =
                $i->galleries->where('category', 'ruangan')->count()
                + $i->galleries->where('category', 'sdm')->count()
                + $i->galleries->where('category', 'layanan')->count();

            // Hitung durasi jam operasional
            try {
                [$start, $end] = explode('-', str_replace(' ', '', $i->jam_operasional));
                $durasiJam = (int) substr($end, 0, 2) - (int) substr($start, 0, 2);
            } catch (\Throwable $e) {
                $durasiJam = 0;
            }

            // Hitung jumlah program pembelajaran
            $jumlahProgram = $i->profile && $i->profile->program_pembelajaran
                ? count(explode(',', $i->profile->program_pembelajaran))
                : 0;

            return [
                'id' => $i->id,
                'nama' => $i->nama,
                'bakat' => $i->bakat, // METADATA
                'biaya' => $i->biaya_pendaftaran,
                'jumlah_fasilitas' => $jumlahFasilitas,
                'jam_operasional' => $durasiJam,
                'jumlah_program' => $jumlahProgram,
            ];
        });
    }
}
