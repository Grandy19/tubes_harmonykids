<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('instansis', function (Blueprint $table) {
            // Menambahkan kolom 'label' setelah kolom 'bakat'
            // nullable() artinya kolom ini boleh kosong
            $table->string('label')->nullable()->after('bakat'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instansis', function (Blueprint $table) {
            // Menghapus kolom label jika di-rollback
            $table->dropColumn('label');
        });
    }
};