<?php

namespace App\Modules\Forum\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ForumPost extends Model
{
    protected $fillable = [
        'wali_id',
        'content',
        'image',
        'likes', // Ini counter jumlah like (angka)
    ];

    // Relasi ke Pembuat Post
    public function wali()
    {
        return $this->belongsTo(User::class, 'wali_id');
    }

    // [BARU] Relasi ke Komentar
    public function comments()
    {
        return $this->hasMany(ForumComment::class, 'forum_post_id');
    }

    // [BARU] Relasi ke Data Like (Detail siapa yang like)
    public function likesData()
    {
        return $this->hasMany(ForumLike::class, 'forum_post_id');
    }
}