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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('genderID')->constrained('genders')->references('genderID');
            $table->foreignId('nationalityID')->constrained('nationalities')->references('nationalityID');
            $table->foreignId('classID')->nullable()->constrained('classes')->references('classID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['genderID']);
            $table->dropColumn('genderID');
            $table->dropForeign(['nationalityID']);
            $table->dropColumn('nationalityID');
            $table->dropForeign(['classID']);
            $table->dropColumn('classID');
        });
    }
};
