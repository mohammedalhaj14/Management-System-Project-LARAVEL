<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_teachers', function (Blueprint $table) {
            $table->id('classTeacherID');
            $table->foreignId('classID')->constrained('classes')->references('classID');
            $table->foreignId('userID')->constrained('users')->references('userID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_teachers');
    }
};
