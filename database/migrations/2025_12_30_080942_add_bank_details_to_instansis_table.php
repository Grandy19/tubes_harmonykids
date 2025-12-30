<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('instansis', function (Blueprint $table) {
            // Menambah kolom baru
            $table->string('nama_bank')->nullable()->after('jam_operasional'); // Contoh: Mandiri, BCA, BNI
            $table->string('atas_nama_rekening')->nullable()->after('nama_bank');
            // Pastikan kolom 'no_rekening' sudah ada sebelumnya, jika belum, tambahkan juga.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instansis', function (Blueprint $table) {
            //
        });
    }
};
