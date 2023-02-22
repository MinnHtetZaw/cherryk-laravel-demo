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
        Schema::create('machinery_item_treatment_unit', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('treatment_unit_id');
            $table->unsignedInteger('machinery_item_id');
            $table->integer('usage_amount');
            $table->integer('usage_cost');
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
        Schema::table('machinery_item_treatment_unit', function (Blueprint $table) {
            //
        });
    }
};
