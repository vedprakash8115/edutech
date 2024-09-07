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
            $table->string('title')->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->float('disc_price', 8, 2)->nullable();
            $table->string('banner')->nullable();
            $table->string('upload_file')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->boolean('free')->default(0);
            $table->boolean('status')->default(1);
            $table->softDeletes()->nullable();
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
