<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondominiumApartmentParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominium_apartment_parkings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('apartment_id')->unsigned();
            $table->bigInteger('parking_id')->unsigned();
            $table->timestamps();

            $table->foreign('apartment_id')->references('id')->on('condominium_apartments');
            $table->foreign('parking_id')->references('id')->on('condominium_parkings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condominium_apartment_parkings');
    }
}
