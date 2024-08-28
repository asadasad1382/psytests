<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('test_id');
            $table->text('question');
            $table->text('choice1')->nullable();
            $table->text('choice2')->nullable();
            $table->text('choice3')->nullable();
            $table->text('choice4')->nullable();
            $table->tinyInteger('answer');
            $table->boolean('random')->default(0);
            $table->text('long_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
