<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('menu_id')->unsigned();
            $table->bigInteger('route_id')->unsigned();
            $table->integer('order')->unsigned();
            $table->string('name');
            $table->string('button')->nullable();
            $table->integer('main')->unsigned()->default(0);
            $table->integer('hidden')->unsigned()->default(0);
            $table->longText('description')->nullable();
            $table->datetime('blocked')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menu');
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('main')->references('id')->on('boolean');
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
        Schema::dropIfExists('menu_items');
    }
}
