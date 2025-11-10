<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_specialities', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->string('description')->nullable(); // if you want descriptions
           $table->foreignId('speciality_id')->constrained()->onDelete('cascade');
           $table->timestamps();
           $table->unique(['name', 'speciality_id']);
      }  );

    }

    public function down(): void
    {
        Schema::dropIfExists('sub_specialities');
    }
};
