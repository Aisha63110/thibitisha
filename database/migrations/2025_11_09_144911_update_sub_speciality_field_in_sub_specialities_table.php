<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Safely drop the unique index on 'name' if it exists
        $indexes = DB::select("
            SHOW INDEX FROM sub_specialities WHERE Key_name = 'sub_specialities_name_unique'
        ");

        if (!empty($indexes)) {
            DB::statement('DROP INDEX sub_specialities_name_unique ON sub_specialities');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_specialities', function (Blueprint $table) {
            // Restore the unique constraint on 'name' if needed
            $table->unique('name', 'sub_specialities_name_unique');
        });
    }
};
