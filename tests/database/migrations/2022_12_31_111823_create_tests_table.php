<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('TName', 250)->nullable();
            $table->integer('NOQ')->nullable();
            $table->boolean('be_default')->default(0);
            $table->boolean('prof_or_user')->default(0);
            $table->boolean('random')->default(0);
            $table->integer('time')->nullable();
            $table->boolean('rtl')->default(1);
            $table->boolean('minus_mark')->default(0);
            $table->boolean('show_answers')->default(1);
            $table->boolean('show_mark')->default(1);
            $table->boolean('active')->default(1);
            $table->text('start_message')->nullable();
            $table->text('end_message')->nullable();
            $table->boolean('p_active')->default(1);
            $table->boolean('show_rank')->default(0);
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
}
