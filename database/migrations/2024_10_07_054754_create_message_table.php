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
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('content'); // The actual message content
            $table->string('type')->default('text'); // Message type (text, image, file, etc.)
            $table->boolean('is_sent')->default(true);
            $table->timestamp('delivered_at')->nullable(); // Timestamp for when the message was delivered
            $table->timestamp('read_at')->nullable(); // Timestamp for when the message was read
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
