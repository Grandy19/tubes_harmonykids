<?php

namespace App\Modules\Forum\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Forum\Models\ForumPost;
use App\Modules\Forum\Models\ForumComment;
use App\Modules\Forum\Models\ForumLike;

class ForumApiController extends Controller
{
    // GET /api/forum - Get all posts
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');
        $sort = $request->query('sort', 'latest');
        
        // Get user from Sanctum token
        $user = null;
        $userId = null;
        
        // Try to get user from Auth (Sanctum middleware)
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;
        } else {
            // Fallback: Extract user ID from token manually
            $token = $request->bearerToken();
            if ($token) {
                $tokenModel = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
                if ($tokenModel) {
                    $userId = $tokenModel->tokenable_id;
                    $user = $tokenModel->tokenable;
                }
            }
        }

        // Debug logging
        \Log::info('Forum API called', [
            'tab' => $tab,
            'sort' => $sort,
            'user_id' => $userId ?? 'NULL',
            'user_name' => $user ? $user->name : 'NULL',
            'auth_check' => Auth::check() ? 'YES' : 'NO',
        ]);

        // Query posts dengan wali relation
        $query = ForumPost::with('wali')
            ->whereHas('wali') // Only posts with valid wali
            ->withCount('comments');

        // Filter by tab (only if user is authenticated)
        if ($tab === 'mine' && $userId) {
            $query->where('wali_id', $userId);
            \Log::info('Filtering by wali_id', ['wali_id' => $userId]);
        }

        // Sorting
        if ($sort === 'popular') {
            $query->orderByDesc('likes');
        } elseif ($sort === 'recommend') {
            $query->orderByDesc('likes')->latest();
        } else {
            $query->latest();
        }

        $posts = $query->get();

        // Get liked post IDs for current user (use empty array if user is null)
        $likedPostIds = $user
            ? ForumLike::where('user_id', $user->id)->pluck('forum_post_id')->toArray()
            : [];

        // Transform to API response
        $data = $posts->map(function ($post) use ($likedPostIds) {
            return [
                'id' => $post->id,
                'wali_id' => $post->wali_id,
                'content' => $post->content,
                'image' => $post->image,
                'likes' => $post->likes ?? 0,
                'comments_count' => $post->comments_count ?? 0,
                'created_at' => $post->created_at->toISOString(),
                'wali' => [
                    'name' => $post->wali->name ?? 'User',
                ],
                'is_liked' => in_array($post->id, $likedPostIds),
            ];
        });

        return response()->json($data);
    }

    // POST /api/forum - Create new post
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
        $data['likes'] = 0;

        $post = ForumPost::create($data);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post
        ], 201);
    }

    // POST /api/forum/{id}/like - Toggle like
    public function like($id)
    {
        $user = Auth::user();
        $post = ForumPost::findOrFail($id);

        $existingLike = ForumLike::where('user_id', $user->id)
            ->where('forum_post_id', $post->id)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $post->decrement('likes');
            $isLiked = false;
        } else {
            // Like
            ForumLike::create([
                'user_id' => $user->id,
                'forum_post_id' => $post->id
            ]);
            $post->increment('likes');
            $isLiked = true;
        }

        return response()->json([
            'liked' => $isLiked,
            'likes' => $post->likes
        ]);
    }

    // GET /api/forum/{id}/comments - Get comments
    public function getComments($id)
    {
        $comments = ForumComment::with('wali')
            ->where('forum_post_id', $id)
            ->latest()
            ->get()
            ->map(function ($c) {
                return [
                    'id' => $c->id,
                    'name' => $c->wali->name ?? 'User',
                    'content' => $c->content,
                    'time' => $c->created_at->diffForHumans()
                ];
            });

        return response()->json($comments);
    }

    // POST /api/forum/{id}/comment - Add comment
    public function storeComment(Request $request, $id)
    {
        $request->validate(['comment' => 'required']);

        $post = ForumPost::findOrFail($id);
        
        $comment = ForumComment::create([
            'forum_post_id' => $post->id,
            'wali_id' => Auth::id(),
            'content' => $request->comment
        ]);

        return response()->json([
            'status' => 'success',
            'comments_count' => $post->comments()->count(),
            'comment' => [
                'id' => $comment->id,
                'name' => Auth::user()->name,
                'content' => $comment->content,
                'time' => 'baru saja'
            ]
        ]);
    }
}
