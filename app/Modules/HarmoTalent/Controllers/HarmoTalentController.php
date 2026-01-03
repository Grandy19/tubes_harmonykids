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
        $kategori = $request->query('kategori'); 
        $sort = $request->query('sort');         

        return view(
            'wali.harmotalent.result.index',
            compact('bakat', 'kategori', 'sort')
        );
    }
}
