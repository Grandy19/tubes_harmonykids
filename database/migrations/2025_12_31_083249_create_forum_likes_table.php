<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum_likes', function (Blueprint $table) {
            $table->id();

            // Relasi ke Postingan
            $table->foreignId('forum_post_id')->constrained('forum_posts')->cascadeOnDelete();

            // Relasi ke User yang melakukan Like
            // Kita pakai 'user_id' agar sesuai dengan Model ForumLike yang kita buat sebelumnya
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // PENTING: Mencegah 1 user melike postingan yang sama berkali-kali
            $table->unique(['forum_post_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_likes');
    }
};