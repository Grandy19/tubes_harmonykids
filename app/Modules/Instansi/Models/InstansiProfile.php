<?php

namespace App\Modules\Instansi\Models;

use Illuminate\Database\Eloquent\Model;

class InstansiProfile extends Model
{
    protected $fillable = [
        'instansi_id',
        'deskripsi',
        'program_pembelajaran',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }
}
