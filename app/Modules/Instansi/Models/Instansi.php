<?php

namespace App\Modules\Instansi\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Instansi\Models\InstansiProfile;
use App\Modules\Instansi\Models\InstansiGallery;

class Instansi extends Model
{
    protected $fillable = [
        'pengelola_id',
        'nama',
        'jenis',
        'lokasi',
        'biaya_pendaftaran',
        'jam_operasional',
        'telepon',
        'email',
        'status',
        'bakat',
        'is_verified',
    ];

    public function profile()
    {
        return $this->hasOne(InstansiProfile::class);
    }

    public function galleries()
    {
        return $this->hasMany(InstansiGallery::class);
    }
}
