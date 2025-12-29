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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instansi_id')->constrained()->cascadeOnDelete();
            $table->foreignId('wali_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_anak');
            $table->date('ttl');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->text('riwayat_kesehatan')->nullable();
            $table->string('kewarganegaraan');
            $table->string('bukti_pembayaran');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
