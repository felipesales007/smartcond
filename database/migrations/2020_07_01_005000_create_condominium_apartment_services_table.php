<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondominiumApartmentServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominium_apartment_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('entity_id')->unsigned();
            $table->string('name')->unique();
            $table->string('rg')->nullable()->unique();
            $table->string('contact')->nullable();
            $table->string('profession')->nullable();
            $table->longText('note')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('entities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condominium_apartment_services');
    }
}
