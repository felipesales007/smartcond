<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('route_option_id')->unsigned();
            $table->integer('view')->unsigned()->default(0);
            $table->string('url');
            $table->string('route')->unique();
            $table->string('controller');
            $table->longText('description')->nullable();
            $table->datetime('blocked')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('route_option_id')->references('id')->on('route_options');
            $table->foreign('view')->references('id')->on('boolean');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
