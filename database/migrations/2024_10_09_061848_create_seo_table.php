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
            $table->string('page_slug')->unique();
            $table->string('title', 60);
            $table->text('meta_description');
            $table->string('meta_keywords')->nullable();
            $table->string('viewport')->nullable();
            $table->string('robots')->nullable();
            $table->string('author')->nullable();
            $table->string('copyright')->nullable();
            $table->string('og_title', 60)->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_image')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_site_name')->nullable();
            $table->string('og_locale')->nullable();
            $table->string('og_audio')->nullable();
            $table->string('og_video')->nullable();
            $table->string('canonical_url')->nullable();
            $table->text('robots_txt')->nullable();
            $table->text('schema_markup')->nullable();
            $table->string('sitemap_url')->nullable();
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
