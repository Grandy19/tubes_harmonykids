<?php

namespace App\Modules\Instansi\Models;

use Illuminate\Database\Eloquent\Model;

class InstansiGallery extends Model
{
    /**
     * =====================
     * TABLE
     * =====================
     */
    protected $table = 'instansi_galleries';

    /**
     * =====================
     * MASS ASSIGNMENT
     * =====================
     */
    protected $fillable = [
        'instansi_id',
        'image_path',
        'category',
        'caption',
    ];

    /**
     * =====================
     * CASTS
     * =====================
     */
    protected $casts = [
        'instansi_id' => 'integer',
        'category'    => 'string',
    ];

    /**
     * =====================
     * KONSTANTA KATEGORI
     * =====================
     */
    public const CATEGORY_UTAMA     = 'utama';
    public const CATEGORY_PROFIL    = 'profil';
    public const CATEGORY_FASILITAS = 'fasilitas';
    public const CATEGORY_SDM       = 'sdm';

    /**
     * =====================
     * RELATION
     * =====================
     */
    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    /**
     * =====================
     * QUERY SCOPES
     * =====================
     */
    public function scopeUtama($query)
    {
        return $query->where('category', self::CATEGORY_UTAMA);
    }

    public function scopeProfil($query)
    {
        return $query->where('category', self::CATEGORY_PROFIL);
    }

    public function scopeFasilitas($query)
    {
        return $query->where('category', self::CATEGORY_FASILITAS);
    }

    public function scopeSdm($query)
    {
        return $query->where('category', self::CATEGORY_SDM);
    }
}
