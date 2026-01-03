<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Instansi\Models\Instansi;
use App\Modules\Forum\Models\ForumPost;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * =========================
     * PROTEKSI ADMIN (SIMPLE)
     * =========================
     */
    private function onlyAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses khusus admin');
        }
    }

    /**
     * =========================
     * DASHBOARD
     * =========================
     */
    public function index()
    {
        $this->onlyAdmin();

        $totalUsers = User::count();
        $totalInstansi = Instansi::count();
        $pendingInstansi = Instansi::where('status', 'pending')->count();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalInstansi',
            'pendingInstansi'
        ));
    }

    /**
     * =========================
     * LIST USER
     * =========================
     */
    public function users()
    {
        $this->onlyAdmin();

        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function showUser($id)
    {
        $this->onlyAdmin();

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * =========================
     * FORUM
     * =========================
     */
    public function forum()
    {
        $this->onlyAdmin();

        $posts = ForumPost::with('wali')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.forum.index', compact('posts'));
    }

    public function deleteForum($id)
    {
        $this->onlyAdmin();

        $post = ForumPost::findOrFail($id);
        $post->delete();

        return redirect()->back()
            ->with('success', 'Postingan forum berhasil dihapus');
    }

    /**
     * =========================
     * INSTANSI
     * =========================
     */
    public function instansi()
    {
        $this->onlyAdmin();

        $instansis = Instansi::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.instansi.index', compact('instansis'));
    }

    public function show($id)
    {
        $this->onlyAdmin();

        $instansi = Instansi::with(['user', 'profile', 'galleries'])
            ->findOrFail($id);

        return view('admin.instansi.show', compact('instansi'));
    }

    public function approveInstansi($id)
    {
        $this->onlyAdmin();

        $instansi = Instansi::findOrFail($id);
        $instansi->status = 'approved';
        $instansi->save();

        return redirect()->back()
            ->with('success', 'Instansi berhasil disetujui');
    }

    public function deleteInstansi($id)
    {
        $this->onlyAdmin();

        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->back()
            ->with('success', 'Instansi berhasil dihapus');
    }
}
