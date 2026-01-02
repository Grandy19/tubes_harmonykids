<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE pendaftarans
            MODIFY status ENUM(
                'pending',
                'verified',
                'accepted',
                'rejected'
            )
            NOT NULL DEFAULT 'pending'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE pendaftarans
            MODIFY status ENUM(
                'pending',
                'rejected'
            )
            NOT NULL DEFAULT 'pending'
        ");
    }
};
