<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('corporate_name');
            $table->string('cnpj')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('contact')->nullable();
            $table->string('postal_code');
            $table->string('address');
            $table->string('house_number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood');
            $table->string('city');
            $table->bigInteger('state_id')->unsigned();
            $table->string('country');
            $table->string('logo')->nullable();
            $table->datetime('last_update_at')->nullable();
            $table->date('blocked_at')->nullable();
            $table->datetime('blocked')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
