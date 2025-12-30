<?php

namespace App\Modules\Instansi\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
    ];

    // =====================
    // RELATIONS
    // =====================

    public function profile()
    {
        return $this->hasOne(InstansiProfile::class);
    }

    public function galleries()
    {
        return $this->hasMany(InstansiGallery::class);
    }

    // 🔥 RELASI YANG KEMARIN HILANG
    public function user()
    {
        return $this->belongsTo(User::class, 'pengelola_id');
    }
}
