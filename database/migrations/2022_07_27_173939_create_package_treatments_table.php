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
        Schema::create('package_treatments', function (Blueprint $table) {
            $table->id();
            $table->integer('treatment_id');
            $table->integer('package_id');
            $table->integer('treatment_unit_id');
            $table->integer('treatment_unit_sale_id');
            $table->string('body_part');
            $table->string('treatment_unit_name');
            $table->string('treatment_unit_type');
            $table->integer('treatment_unit_quantity');
            $table->integer('treatment_unit_origin_amount');
            $table->integer('treatment_unit_amount');
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
        Schema::dropIfExists('package_treatments');
    }
};
