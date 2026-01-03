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
        'jenis_pembayaran',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'pengelola_id');
    }

    /**
     * RELASI UMUM (UNTUK API / HARMOFIND)
     */
    public function galleries()
    {
        return $this->hasMany(InstansiGallery::class);
    }

    /**
     * RELASI SPESIFIK (DETAIL)
     */
    public function galleryUtama()
    {
        return $this->hasOne(InstansiGallery::class)
            ->where('category', 'utama');
    }

    public function galleryProfil()
    {
        return $this->hasMany(InstansiGallery::class)
            ->where('category', 'profil');
    }

    public function galleryFasilitas()
    {
        return $this->hasMany(InstansiGallery::class)
            ->where('category', 'fasilitas');
    }

    public function gallerySDM()
    {
        return $this->hasMany(InstansiGallery::class)
            ->where('category', 'sdm');
    }
}