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
    Schema::create('verification_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('practitioner_id')->constrained()->onDelete('cascade');
        $table->string('ip_address')->nullable();
        $table->string('user_agent')->nullable();
        $table->boolean('is_valid')->default(false);
        $table->timestamp('verified_at')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('verification_logs');
}

};
