<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes__questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Quizze_id');
            $table->integer('Question_id');
            $table->string('Question_title');
            $table->integer('iscorrect');
            $table->integer('student_answer');
            $table->integer('correct_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes__questions');
    }
}
