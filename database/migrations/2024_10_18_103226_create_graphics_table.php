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
        Schema::create('graphics', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->integer('logo_width');
            $table->integer('logo_height');
            $table->string('background_color');
            $table->string('gradient_color_2')->nullable();
            $table->string('custom_text')->nullable();
            $table->enum('text_size', ['small', 'medium', 'large']);
            $table->string('text_color');
            $table->string('custom_url')->nullable();
            $table->enum('condition', ['none', 'date', 'time', 'interval']);
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->enum('interval', ['morning', 'afternoon', 'evening', 'night'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graphics');
    }
};
