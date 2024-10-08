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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->nullable();
            $table->integer('publication_year');
            
            $table->text('description')->nullable();
        
            // Define foreign key as unsignedBigInteger to match the id in video_courses
            $table->unsignedBigInteger('videocourse_id');
        
            // Foreign key constraint linking to id in video_courses
            $table->foreign('videocourse_id')
                  ->references('id')
                  ->on('video_courses')
                  ->onDelete('cascade');
        
                  $table->boolean('is_paid')->default(false);
                  $table->decimal('price', 8, 2)->nullable();
                  $table->decimal('discount_price', 8, 2)->nullable();
            $table->string('cover_image')->nullable();
            $table->string('book_file')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
