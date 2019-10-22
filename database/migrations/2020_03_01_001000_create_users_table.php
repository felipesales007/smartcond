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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cpf')->nullable()->unique();
            $table->string('rg')->nullable()->unique();
            $table->string('email')->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->date('birthday')->nullable();
            $table->string('contact')->nullable();
            $table->bigInteger('gender_id')->nullable()->unsigned();
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->string('course')->nullable();
            $table->string('college')->nullable();
            $table->string('profession')->nullable();
            $table->string('company')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address')->nullable();
            $table->string('house_number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('state_id')->nullable()->unsigned();
            $table->foreign('state_id')->references('id')->on('states');
            $table->string('country')->nullable();
            $table->longText('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('background')->nullable();
            $table->integer('admin')->unsigned()->default(0);
            $table->foreign('admin')->references('id')->on('boolean');
            $table->string('last_login_ip')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->datetime('last_update_at')->nullable();
            $table->date('blocked_at')->nullable();
            $table->datetime('blocked')->nullable();
            $table->string('access_token')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
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
