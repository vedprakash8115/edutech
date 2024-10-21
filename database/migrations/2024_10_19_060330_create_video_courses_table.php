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
            $table->boolean('is_paid')->default(false);
            $table->boolean('show_on_website')->default('0');
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('discount_price', 8, 2)->nullable();
       
            $table->string('banner')->nullable();
            $table->string('course_validity')->nullable();
          
            $table->integer('course_duration')->nullable();
            $table->string('course_category_id')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('status')->default(1);
            $table->softdeletes();
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
