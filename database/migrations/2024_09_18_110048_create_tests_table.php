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
            $table->integer('total_questions');
            $table->integer('available_questions')->nullable();
            $table->integer('number_of_subjects')->nullable();
            $table->integer('optional_questions')->nullable();
          
            $table->integer('passing_score');
            $table->boolean('is_active')->default(false);
            $table->enum('test_type', ['mcq', 'descriptive','true_false']);
            // $table->enum('category', ['mcq', 'descriptive','true_false']);
         
            $table->integer('time_limit')->nullable(); // Time limit per question
            $table->boolean('is_randomized')->default(false);
            $table->boolean('has_negative_marks')->default(false);
            $table->decimal('negative_marks', 5, 2)->nullable();
            // $table->integer('negative_marks')->nullable();
            $table->boolean('allow_optional_questions')->default(false);
            $table->integer('question_attempt')->nullable(); // number of questions to attempt
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
