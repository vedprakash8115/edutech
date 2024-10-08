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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('query_id'); // Refers to the ticket
            $table->unsignedBigInteger('sender_id'); // Refers to the user who sent the message (student or agent)
            $table->text('message');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('query_id')->references('id')->on('queries')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
