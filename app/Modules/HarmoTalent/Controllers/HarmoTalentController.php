<?php

namespace App\Modules\HarmoTalent\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Instansi\Models\Instansi;

class HarmoTalentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'bakat' => 'required',
        ]);

        return Instansi::where('status', 'approved')
            ->where('bakat', $request->bakat)
            ->select(
                'id',
                'nama',
                'bakat',
                'lokasi',
                'biaya_pendaftaran'
            )
            ->get();
    }
}
