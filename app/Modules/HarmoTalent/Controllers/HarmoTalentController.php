<?php

namespace App\Modules\HarmoTalent\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HarmoTalentController extends Controller
{
    // =======================
    // HALAMAN PILIH BAKAT
    // =======================
    public function index()
    {
        return view('wali.harmotalent.index');
    }

    // =======================
    // HALAMAN HASIL (HARMO TALENT)
    // =======================
    public function result(Request $request)
    {
        // Ambil parameter dari URL
        $bakat = $request->query('bakat');
        $kategori = $request->query('kategori'); // boleh null
        $sort = $request->query('sort');         // boleh null

        /**
         * CATATAN PENTING:
         * - Controller ini TIDAK melakukan query database
         * - Semua data akan diambil via AJAX (API Instansi)
         * - Ini agar HarmoTalent konsisten dengan HarmoFind
         */

        return view(
            'wali.harmotalent.result.index',
            compact('bakat', 'kategori', 'sort')
        );
    }
}
