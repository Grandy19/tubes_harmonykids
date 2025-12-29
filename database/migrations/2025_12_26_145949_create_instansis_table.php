<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengelola_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('nama');
            $table->enum('jenis', ['TK/PG', 'Daycare']);
            $table->string('lokasi');

            $table->integer('biaya_pendaftaran');
            $table->string('jam_operasional');
            $table->string('telepon');
            $table->string('email');

            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};