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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->string('coupon_code');
            $table->date('start_date');
            $table->date('expiry_date');
            $table->string('discount_type');
            $table->string('product_type');
            $table->string('inspirant_applicant');
            $table->string('percentage')->nullable();
            $table->string('fixed_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
