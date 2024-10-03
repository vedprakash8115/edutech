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
        Schema::create('folder_hierarchy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ancestor_id');
            $table->unsignedBigInteger('descendant_id');
            $table->integer('depth');
    
            $table->foreign('ancestor_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('descendant_id')->references('id')->on('folders')->onDelete('cascade');
    
            $table->unique(['ancestor_id', 'descendant_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('closure');
    }
};
