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
        Schema::create('kit_units', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('current_qty');
            $table->integer('reorder_qty')->default(0);
            $table->integer('selling_price');
            $table->integer('purchase_price');
            $table->integer('per_unit_qty')->nullable();
            $table->float('from_unit')->nullable();
            $table->float('to_unit')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('kit_item_id');
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
        Schema::dropIfExists('kit_units');
    }
};
