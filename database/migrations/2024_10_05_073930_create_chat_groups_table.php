<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the group (subject)
            $table->unsignedBigInteger('video_course_id'); // Foreign key linking to video course
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->text('description')->nullable(); // Optional description of the group
            $table->boolean('is_active')->default(true); // Whether the group is active or not
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null'); // Foreign key definition

            $table->foreign('video_course_id')->references('id')->on('video_courses')->onDelete('cascade'); // Link to video course
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_groups_migration');
    }
};
