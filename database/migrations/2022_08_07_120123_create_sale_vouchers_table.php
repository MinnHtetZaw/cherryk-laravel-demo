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
        Schema::create('sale_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_no');
            $table->integer('total_price');
            $table->string('sale_by')->nullable();
            $table->date('voucher_date');
            $table->string('customer_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('remark')->nullable();
            $table->integer('pay')->default(0);
            $table->integer('refund')->default(0);
            $table->integer('advance')->default(0);
            $table->integer('balance')->default(0);
            $table->string('discount_type')->nullable();
            $table->integer('discount_value')->default(0);
            $table->integer('net_amount');
            $table->enum('payment_type',[0,1,2])->comment('Cash Down, Partial, Bank');
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
        Schema::dropIfExists('sale_vouchers');
    }
};
