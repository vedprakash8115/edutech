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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->foreignId('folder_id')->nullable()->constrained()->onDelete('cascade'); // Link files to a folder
            $table->foreignId('video_course_id')->constrained()->onDelete('cascade'); // Link files to a specific video course
            $table->enum('type', ['pdf', 'image', 'video', 'other']); // File types
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
