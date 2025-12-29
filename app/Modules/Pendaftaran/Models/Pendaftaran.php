<?php

namespace App\Modules\Pendaftaran\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Instansi\Models\Instansi;
use App\Models\User;

class Pendaftaran extends Model
{
    protected $fillable = [
        'instansi_id',
        'wali_id',
        'nama_anak',
        'ttl',
        'jenis_kelamin',
        'alamat',
        'riwayat_kesehatan',
        'kewarganegaraan',
        'bukti_pembayaran',
        'status',
    ];

    // =====================
    // RELASI
    // =====================

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function wali()
    {
        return $this->belongsTo(User::class, 'wali_id');
    }
}
