<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_procedure_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('treatment_unit_id');
            $table->bigInteger('medicine_id');
            $table->string('medicine_name');
            $table->integer('qty');
            $table->integer('selling_price');
            $table->integer('total_price');
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
        Schema::dropIfExists('treatment_procedure_items');
    }
};
