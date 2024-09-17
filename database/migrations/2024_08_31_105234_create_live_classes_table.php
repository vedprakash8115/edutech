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
        Schema::create('live_classes', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->nullable();
            $table->string('language')->nullable();
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed');
            $table->integer('original_price')->nullable();
            $table->integer('discount_price')->nullable();
            
            $table->string('banner')->nullable();
            $table->string('course_duration')->nullable();

            $table->string('about_course')->nullable();
            $table->integer('cat_level_0')->nullable();
            $table->integer('cat_level_1')->nullable();
            $table->integer('cat_level_2')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_classes');
    }
};
