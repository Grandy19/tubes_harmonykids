<?php

namespace App\Modules\Forum\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Forum\Models\ForumPost;
use App\Modules\Forum\Models\ForumComment; // Pastikan Model ini ada
use App\Modules\Forum\Models\ForumLike;    // Pastikan Model ini ada

class ForumController extends Controller
{
    // TAMPILKAN HALAMAN UTAMA (Gabungan Index & Mine)
    public function index(Request $request)
    {
        // Ambil parameter dari URL (default 'all' dan 'latest')
        $tab = $request->query('tab', 'all');
        $sort = $request->query('sort', 'latest');
        $user = Auth::user();

        // Query Dasar dengan Eager Loading (Wali & Hitung Komentar)
        $query = ForumPost::with('wali')->withCount('comments');

        // Filter: Post Saya
        if ($tab === 'mine') {
            $query->where('wali_id', $user->id);
        }

        // Logic Sorting 
        if ($sort === 'popular') {
            $query->orderByDesc('likes'); 
        } elseif ($sort === 'recommend') {
            $query->orderByDesc('likes')->latest();
        } else {
            $query->latest();
        }

        // Eksekusi Query
        $posts = $query->get();

        // Ambil ID postingan yang sudah dilike oleh user ini (untuk tombol merah/abu)
        // Asumsi ada tabel/model 'likes' relasi ke user
        $likedPostIds = ForumLike::where('user_id', $user->id)
            ->pluck('forum_post_id') // Sesuaikan nama kolom foreign key post
            ->toArray();

        // Return ke View 
        return view('wali.harmotalk.index', compact('posts', 'tab', 'sort', 'likedPostIds'));
    }

    // HALAMAN FORM CREATE (Jika view dipisah)
    public function create()
    {
        return view('wali.harmotalk.create');
    }

    // SIMPAN POST BARU
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('forum', 'public');
        }

        $data['wali_id'] = Auth::id();
        $data['likes'] = 0; // Inisialisasi counter

        ForumPost::create($data);

        // Redirect kembali ke halaman forum dengan tab 'all'
        return redirect()->route('wali.harmotalk', ['tab' => 'all'])
            ->with('success', 'Postingan berhasil diterbitkan!');
    }

    // 4. LOGIKA LIKE (AJAX)
    public function like($id)
    {
        $user = Auth::user();
        $post = ForumPost::findOrFail($id);

        // Cek apakah user sudah like
        $existingLike = ForumLike::where('user_id', $user->id)
            ->where('forum_post_id', $post->id)
            ->first();

        if ($existingLike) {
            // UNLIKE: Hapus data like & Kurangi counter
            $existingLike->delete();
            $post->decrement('likes');
            $isLiked = false;
        } else {
            // LIKE: Buat data like & Tambah counter
            ForumLike::create([
                'user_id' => $user->id,
                'forum_post_id' => $post->id
            ]);
            $post->increment('likes');
            $isLiked = true;
        }

        // Return JSON untuk JS fetch()
        return response()->json([
            'liked' => $isLiked,
            'likes' => $post->likes
        ]);
    }

    // AMBIL KOMENTAR (AJAX)
    public function getComments($id)
    {
        $comments = ForumComment::with('wali')
            ->where('forum_post_id', $id)
            ->latest()
            ->get()
            ->map(function ($c) {
                return [
                    'name' => $c->wali->name ?? 'User',
                    'content' => $c->content,
                    'time' => $c->created_at->diffForHumans()
                ];
            });

        return response()->json($comments);
    }

    // KIRIM KOMENTAR (AJAX)
    public function storeComment(Request $request, $id)
    {
        $request->validate(['comment' => 'required']);

        $post = ForumPost::findOrFail($id);
        
        $comment = ForumComment::create([
            'forum_post_id' => $post->id,
            'wali_id' => Auth::id(),
            'content' => $request->comment
        ]);

        // Return JSON agar JS bisa append komentar baru tanpa refresh
        return response()->json([
            'status' => 'success',
            'comments_count' => $post->comments()->count(),
            'comment' => [
                'name' => Auth::user()->name,
                'content' => $comment->content,
                'time' => 'baru saja'
            ]
        ]);
    }
}