<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTestAttemptsTable extends Migration
{
    public function up()
    {
        Schema::create('student_test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->integer('total_score');
            $table->boolean('is_passed');
            $table->integer('attempt_number')->default(1);
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_test_attempts');
    }
}
