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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('email');
            $table->string('mobile')->nullable()->unique()->after('last_name');
            $table->string('address')->nullable()->after('mobile');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('country')->nullable()->after('state');
            $table->integer('pincode')->nullable()->after('country');
            $table->string('image')->nullable()->after('pincode');
            $table->enum('status', [0, 1])->default(1)->after('image');
            $table->integer('role_id')->nullable()->after('status');
            $table->text('details')->nullable()->after('role_id');
            $table->string('facebook_link')->nullable()->after('details');
            $table->string('youtube_url')->nullable()->after('facebook_link');
            $table->string('twitter_url')->nullable()->after('youtube_url');
            $table->string('linkedin_url')->nullable()->after('twitter_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_name',
                'mobile',
                'address',
                'city',
                'state',
                'country',
                'pincode',
                'image',
                'status',
                'role_id',
                'details',
                'facebook_link',
                'youtube_url',
                'twitter_url',
                'linkedin_url'
            ]);
        });
    }
};
