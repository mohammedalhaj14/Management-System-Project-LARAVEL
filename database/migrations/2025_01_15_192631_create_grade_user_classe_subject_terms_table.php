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
        Schema::create('grade_user_classe_subject_terms', function (Blueprint $table) {
            $table->id('GradeUserClasseSubjectTermID');
            $table->foreignId('gradeID')->constrained('grades')->references('gradeID')->onDelete('cascade');
            $table->foreignId('userID')->constrained('users')->references('userID')->onDelete('cascade');
            $table->foreignId('classID')->constrained('classes')->references('classID')->onDelete('cascade');
            $table->foreignId('subjectID')->constrained('subjects')->references('subjectID')->onDelete('cascade');
            $table->foreignId('termID')->constrained('terms')->references('termID')->onDelete('cascade');
            $table->string('role')->default('student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_user_classe_subject_terms');
    }
};
