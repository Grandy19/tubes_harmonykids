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
            $table->enum('bakat', [
                'Seni & Kreativitas',
                'Musik',
                'Olahraga',
                'Akademik Dasar',
                'Sains & Eksperimen',
                'Sosial & Komunikasi',
            ])->nullable()->after('jenis');
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
