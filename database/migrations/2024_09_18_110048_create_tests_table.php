<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('duration'); // in minutes
            $table->integer('total_marks');
            $table->enum('difficulty_level', ['easy', 'medium', 'hard']);
            $table->integer('passing_score');
            $table->boolean('is_active')->default(true);
            $table->enum('test_type', ['practice', 'mock', 'final']);
            $table->timestamp('creation_date')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->integer('time_limit')->nullable(); // Time limit per question
            $table->boolean('is_randomized')->default(false);
            $table->boolean('has_negative_marks')->default(false);
            $table->decimal('negative_marks', 5, 2)->nullable();
            $table->boolean('allow_multiple_attempts')->default(false);
            $table->integer('max_attempts')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
