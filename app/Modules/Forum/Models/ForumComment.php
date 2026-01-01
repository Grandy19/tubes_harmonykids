<?php

namespace App\Modules\Forum\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ForumComment extends Model
{
    protected $fillable = [
        'forum_post_id',
        'wali_id',
        'content'
    ];

    // Relasi ke User yang berkomentar
    public function wali()
    {
        return $this->belongsTo(User::class, 'wali_id');
    }

    // Relasi balik ke Postingan
    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'forum_post_id');
    }
}