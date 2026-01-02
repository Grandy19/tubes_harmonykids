<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('instansi_likes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('instansi_id')
                ->constrained('instansis')
                ->cascadeOnDelete();

            $table->timestamps();

            // 👉 Cegah like ganda
            $table->unique(['user_id', 'instansi_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instansi_likes');
    }
};
