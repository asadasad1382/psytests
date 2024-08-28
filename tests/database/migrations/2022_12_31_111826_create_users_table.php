<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('FName', 30)->nullable();
            $table->string('LName', 30)->nullable();
            $table->string('fatherName', 30)->nullable();
            $table->string('userid', 20)->unique('userid');
            $table->string('password', 20);
            $table->string('email', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
