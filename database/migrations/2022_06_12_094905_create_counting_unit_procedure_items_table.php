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
        Schema::create('counting_unit_procedure_items', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('current_qty');
            $table->integer('reorder_qty')->default(0);
            $table->integer('selling_price');
            $table->integer('selling_percent');
            $table->integer('purchase_price');
            $table->integer('per_unit_qty')->nullable();
            $table->float('from_unit')->nullable();
            $table->float('to_unit')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('procedure_item_id');
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
        Schema::dropIfExists('counting_unit_procedure_items');
    }
};
