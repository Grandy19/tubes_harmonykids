<?php

namespace App\Modules\Forum\Models;

use Illuminate\Database\Eloquent\Model;

class ForumLike extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'forum_post_id',
        'user_id' // ID user yang melakukan like
    ];
}