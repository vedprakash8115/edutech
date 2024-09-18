<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('test_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->decimal('weight', 5, 2)->nullable(); // Optional weightage
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_subjects');
    }
}
