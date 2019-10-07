<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->bigInteger('inventory_category_id')->unsigned();
            $table->foreign('inventory_category_id')->references('id')->on('inventory_categories');
            $table->bigInteger('inventory_state_id')->unsigned();
            $table->foreign('inventory_state_id')->references('id')->on('inventory_states');
            $table->bigInteger('voltage_id')->unsigned();
            $table->foreign('voltage_id')->references('id')->on('voltages');
            $table->integer('patrimonial_number')->nullable();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('invoice')->nullable();
            $table->decimal('value', 8, 2)->nullable();
            $table->longText('description')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('warranty_date')->nullable();
            $table->datetime('blocked')->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
