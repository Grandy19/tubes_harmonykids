<?php

namespace App\Modules\Instansi\Models;

use Illuminate\Database\Eloquent\Model;

class InstansiGallery extends Model
{
    protected $fillable = [
        'instansi_id',
        'image_path',
        'category',
        'caption',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }
}
