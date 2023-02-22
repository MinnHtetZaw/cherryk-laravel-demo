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
        Schema::create('treatment_unit_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatment_unit_id');
            $table->integer('selling_price');
            $table->string('type');
            $table->string('type_option');
            $table->string('interval_type')->nullable();
            $table->string('interval_value')->nullable();
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
        Schema::dropIfExists('treatment_unit_sales');
    }
};
