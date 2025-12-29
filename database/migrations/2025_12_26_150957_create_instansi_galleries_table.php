<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('instansi_galleries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('instansi_id')
                ->constrained('instansis')
                ->onDelete('cascade');

            $table->string('image_path');
            $table->enum('category', ['galeri', 'ruangan', 'sdm', 'layanan']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instansi_galleries');
    }
};
