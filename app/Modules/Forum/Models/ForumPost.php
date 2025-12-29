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
        'likes',
    ];

    public function wali()
    {
        return $this->belongsTo(User::class, 'wali_id');
    }
}
