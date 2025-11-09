<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('degrees', function (Blueprint $table) {
            // Drop unique index only if it exists
            $indexes = DB::select("
                SHOW INDEX FROM degrees WHERE Key_name = 'degrees_abbrev_unique'
            ");

            if (!empty($indexes)) {
                DB::statement('DROP INDEX degrees_abbrev_unique ON degrees');
            }

            // Add or modify abbrev column
            if (!Schema::hasColumn('degrees', 'abbrev')) {
                $table->string('abbrev')->nullable();
            } else {
                $table->string('abbrev')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('degrees', function (Blueprint $table) {
            if (Schema::hasColumn('degrees', 'abbrev')) {
                $table->string('abbrev', 15)->change();
                $table->unique('abbrev', 'degrees_abbrev_unique');
            }
        });
    }
};
