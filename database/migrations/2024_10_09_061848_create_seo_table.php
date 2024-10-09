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
        Schema::create('seo', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('canonical_url')->nullable();
            $table->string('keywords')->nullable();
            $table->string('og_title')->nullable(); // Open Graph
            $table->text('og_description')->nullable();
            $table->string('schema_markup')->nullable(); // JSON-LD Schema
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo');
    }
};
