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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('channel')->nullable();
            $table->string('event')->nullable();
            $table->text('message')->nullable();
            $table->string('title')->nullable();
            // $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->string('link_url')->nullable(); // Optional link
            $table->string('image_path')->nullable(); // Optional image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
