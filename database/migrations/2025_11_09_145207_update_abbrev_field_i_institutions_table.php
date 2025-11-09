<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            // Add the abbrev column as nullable
            $table->string('abbrev')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            // Drop the abbrev column if rolling back
            $table->dropColumn('abbrev');
        });
    }
};
