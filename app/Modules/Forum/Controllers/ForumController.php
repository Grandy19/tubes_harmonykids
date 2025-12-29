<?php

namespace App\Modules\Forum\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Forum\Models\ForumPost;

class ForumController extends Controller
{
    // LIST POSTINGAN
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'latest');

        $query = ForumPost::with('wali');

        if ($sort === 'popular') {
            $query->orderByDesc('likes');
        } elseif ($sort === 'recommend') {
            $query->orderByDesc('likes')->latest();
        } else {
            $query->latest();
        }

        return $query->get();
    }

    // BUAT POST
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('forum', 'public');
        }

        $data['wali_id'] = $request->user()->id;

        return ForumPost::create($data);
    }

    // POST MILIK WALI SENDIRI
    public function mine(Request $request)
    {
        $sort = $request->query('sort', 'latest');

        $query = ForumPost::where('wali_id', $request->user()->id);

        if ($sort === 'popular') {
            $query->orderByDesc('likes');
        } elseif ($sort === 'recommend') {
            $query->orderByDesc('likes')->latest();
        } else {
            $query->latest();
        }

        return $query->get();
    }
}