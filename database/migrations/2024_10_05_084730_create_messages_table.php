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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id'); // Refers to the ticket
            $table->unsignedBigInteger('sender_id'); // Refers to the user who sent the message (student or agent)
            $table->text('message');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
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
