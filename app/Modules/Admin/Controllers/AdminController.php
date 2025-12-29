<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Instansi\Models\Instansi;
use App\Modules\Forum\Models\ForumPost;

class AdminController extends Controller
{
    /**
     * =========================
     * DASHBOARD ADMIN
     * =========================
     */
    public function dashboard()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_instansis' => Instansi::count(),
            'pending_instansis' => Instansi::where('status', 'pending')->count(),
        ]);
    }

    /**
     * =========================
     * LIST SEMUA USER
     * =========================
     */
    public function users()
    {
        return User::select('id', 'name', 'email', 'role', 'created_at')->get();
    }

    /**
     * =========================
     * DELETE INSTANSI (ADMIN)
     * =========================
     */
    public function deleteInstansi($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return response()->json([
            'message' => 'Instansi berhasil dihapus oleh admin'
        ]);
    }
}
