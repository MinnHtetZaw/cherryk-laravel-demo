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
        Schema::create('counting_unit_items', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('current_qty');
            $table->integer('reorder_qty')->default(0);
            $table->integer('selling_price');
//            $table->integer('membership_price');
//            $table->integer('vip_price');
            $table->integer('purchase_price');
            $table->unsignedBigInteger('item_id');
            $table->integer('selling_percent');
            $table->float('to_unit')->nullable();
            $table->float('from_unit')->nullable();
            $table->text('description')->nullable();
//            $table->integer('membership_fixed_percent')->nullable();
//            $table->integer('vip_fixed_percent')->nullable();
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
        Schema::dropIfExists('counting_unit_items');
    }
};
