<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('menu_option_id')->unsigned();
            $table->bigInteger('color_id')->unsigned();
            $table->integer('hidden')->unsigned()->default(0);
            $table->integer('order')->unsigned();
            $table->string('name');
            $table->string('icon');
            $table->longText('description')->nullable();
            $table->datetime('blocked')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('menu_option_id')->references('id')->on('menu_options');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('hidden')->references('id')->on('boolean');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
