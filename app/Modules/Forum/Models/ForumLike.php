<?php

namespace App\Modules\Forum\Models;

use Illuminate\Database\Eloquent\Model;

class ForumLike extends Model
{
    // Kita tidak butuh timestamp created_at/updated_at untuk like (opsional, tapi biar hemat storage)
    public $timestamps = false; 

    protected $fillable = [
        'forum_post_id',
        'user_id' // ID user yang melakukan like
    ];
}