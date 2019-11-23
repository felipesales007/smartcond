<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('entity_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('preferred')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('entities');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('preferred')->references('id')->on('boolean');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_accesses');
    }
}
