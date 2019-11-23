<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_level_id')->unsigned();
            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->datetime('blocked')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_level_id')->references('id')->on('user_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
