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
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id(); // Optional, depending on your design
            $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // Refers to the Group model
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); // Refers to the users table
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('subject_teacher');
    }
    
};
