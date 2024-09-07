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
        Schema::create('video_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->nullable();
            $table->string('language')->nullable();
            $table->integer('original_price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->string('banner')->nullable();
            $table->string('video')->nullable();
            $table->integer('course_duration')->nullable();
            $table->string('about_course')->nullable();
            $table->string('course_category_id')->nullable();
            $table->date('form')->nullable();
            $table->date('to')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_courses');
    }
};
