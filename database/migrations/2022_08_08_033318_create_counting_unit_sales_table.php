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
        Schema::create('counting_unit_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_voucher_id');
            $table->unsignedBigInteger('item_id');
            $table->string('item_name');
            $table->integer('item_qty');
            $table->integer('item_price');
            $table->integer('item_sub_total');
            $table->string('item_discount_type')->nullable();
            $table->integer('item_discount_value')->default(0);
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
        Schema::dropIfExists('counting_unit_sales');
    }
};
