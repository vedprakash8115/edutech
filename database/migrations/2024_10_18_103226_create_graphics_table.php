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
            $table->enum('logo_horizontal_position', ['left', 'center', 'right']);
            $table->enum('logo_vertical_position', ['top', 'middle', 'bottom']);
            $table->string('header_background_color');
            $table->string('header_border_color');
            $table->string('header_text');
            $table->string('header_text_color');
            $table->enum('header_text_horizontal_position', ['left', 'center', 'right']);
            $table->enum('header_text_vertical_position', ['top', 'middle', 'bottom']);
            $table->string('header_font');
            $table->integer('header_font_size');
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
