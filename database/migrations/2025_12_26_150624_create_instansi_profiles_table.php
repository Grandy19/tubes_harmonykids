<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('instansi_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('instansi_id')
                ->constrained('instansis')
                ->onDelete('cascade')
                ->unique();

            $table->text('sekilas_tentang_kami')->nullable();
            $table->text('program_pembelajaran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instansi_profiles');
    }
};
