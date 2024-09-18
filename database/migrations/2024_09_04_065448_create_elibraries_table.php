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
        Schema::create('elibraries', function (Blueprint $table) {
            $table->id();
        $table->string('title');
        $table->unsignedBigInteger('cat_level_0');
        $table->unsignedBigInteger('cat_level_1')->nullable();
        $table->unsignedBigInteger('cat_level_2')->nullable();
        $table->string('banner')->nullable(); // Path to the banner image
        $table->boolean('is_paid')->default(false);
        $table->decimal('price', 8, 2)->nullable();
       
        $table->decimal('discount_price', 8, 2)->nullable();
        $table->integer('course_duration')->nullable();
        $table->text('description')->nullable();
        $table->softDeletes();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elibraries');
    }
};
