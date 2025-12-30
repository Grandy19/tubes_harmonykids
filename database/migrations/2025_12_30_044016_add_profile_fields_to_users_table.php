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
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom yang kurang
            $table->string('alamat')->nullable()->after('email');
            $table->string('jenis_kelamin')->nullable()->after('alamat');
            $table->string('pekerjaan')->nullable()->after('jenis_kelamin');
            $table->string('hubungan_dengan_anak')->nullable()->after('pekerjaan');
            $table->string('foto_profil')->nullable()->after('hubungan_dengan_anak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
