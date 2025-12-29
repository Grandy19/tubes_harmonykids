<?php

namespace App\Modules\Instansi\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Instansi\Models\Instansi;

class AdminInstansiController extends Controller
{
    public function pending()
    {
        return Instansi::where('status', 'pending')->get();
    }

    public function approve($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->update(['status' => 'approved']);

        return response()->json(['message' => 'Instansi approved']);
    }

    public function reject($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->update(['status' => 'rejected']);

        return response()->json(['message' => 'Instansi rejected']);
    }
}
