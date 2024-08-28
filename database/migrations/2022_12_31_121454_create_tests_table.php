<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->integer('number_of_question');
            $table->boolean('default')->default(0);
            $table->boolean('random')->default(1);
            $table->integer('time');
            $table->string('rtl')->default(1);
            $table->boolean('minus_mark')->default(0);
            $table->boolean('show_answers')->default(1);
            $table->boolean('show_mark')->default(1);
            $table->boolean('show_rank')->default(0);
            $table->boolean('active')->default(1);
            $table->text('start_message')->nullable();
            $table->text('end_message')->nullable();
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
        Schema::dropIfExists('tests');
    }
};
