<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondominiumApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominium_apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('entity_id')->unsigned();
            $table->bigInteger('block_id')->unsigned();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('entities');
            $table->foreign('block_id')->references('id')->on('condominium_blocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condominium_apartments');
    }
}
