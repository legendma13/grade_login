<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classlist', function (Blueprint $table) {
            $table->id();
            $table->string('teacherID');
            $table->string('studentID');
            $table->string('subject');
            $table->double('grade', 5, 2);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classlist');
    }
};