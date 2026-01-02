<?php

namespace App\Modules\Wali\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Instansi\Models\Instansi;
use Illuminate\Http\Request;

class LikedController extends Controller
{
    public function index(Request $request)
    {
        $instansis = $request->user()
            ->likedInstansis()
            ->with('galleryUtama')
            ->latest()
            ->get();

        return view('wali.disukai.index', compact('instansis'));
    }

    public function toggle(Request $request, $id)
    {
        $instansi = Instansi::findOrFail($id);

        $request->user()
            ->likedInstansis()
            ->toggle($instansi->id);

        return redirect()->back();
    }
}
