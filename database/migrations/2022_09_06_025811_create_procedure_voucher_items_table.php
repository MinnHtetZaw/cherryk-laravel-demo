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
        Schema::create('procedure_voucher_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_voucher_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->integer('qty');
            $table->bigInteger('selling_price');
            $table->bigInteger('total_price');
            $table->string('discount_type')->nullable();
            $table->bigInteger('discount_value')->default(0);
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
        Schema::dropIfExists('procedure_voucher_items');
    }
};
