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
        Schema::create('folder_liveclasses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liveclass_id');
            $table->unsignedBigInteger('folder_id');
            $table->foreign('liveclass_id')->references('id')->on('live_classes')->onDelete('cascade');
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder_liveclass');
    }
};
