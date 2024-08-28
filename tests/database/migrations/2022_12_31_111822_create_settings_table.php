<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('admin_id', 20);
            $table->string('password', 20);
            $table->string('language', 30)->nullable();
            $table->tinyInteger('rtl')->nullable();
            $table->boolean('all_tests')->default(1);
            $table->text('home_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
