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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->string('supplier_name');
            $table->unsignedBigInteger('supplier_id');
            $table->bigInteger('total_price');
            $table->integer('total_qty');
            $table->text('remark')->nullable();
            $table->string('payment_type');
            $table->bigInteger('credit_amount')->default(0);
            $table->bigInteger('pay_amount')->default(0);
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
        Schema::dropIfExists('purchases');
    }
};
