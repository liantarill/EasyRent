<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('rents')) {
            return;
        }

        // Perluas rent_status agar mengizinkan nilai "Cancelled"
        DB::statement('ALTER TABLE rents DROP CONSTRAINT IF EXISTS rents_rent_status_check');
        DB::statement("ALTER TABLE rents ADD CONSTRAINT rents_rent_status_check CHECK (rent_status IN ('Pending Verification','Verified','Rejected','Cancelled'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('rents')) {
            return;
        }

        // Kembalikan ke constraint semula tanpa "Cancelled"
        DB::statement('ALTER TABLE rents DROP CONSTRAINT IF EXISTS rents_rent_status_check');
        DB::statement("ALTER TABLE rents ADD CONSTRAINT rents_rent_status_check CHECK (rent_status IN ('Pending Verification','Verified','Rejected'))");
    }
};
