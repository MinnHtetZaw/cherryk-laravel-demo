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
        Schema::create('procedure_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('procedure_voucher_number');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->bigInteger('consultation_charges')->default(0);
            $table->bigInteger('service_charges')->default(0);
            $table->bigInteger('total_amount')->default(0);
            $table->bigInteger('pay_amount')->default(0);
            $table->bigInteger('balance')->default(0);
            $table->boolean('is_discount')->default(false);
            $table->string('discount_type')->nullable();
            $table->integer('discount_value')->default(0);
            $table->boolean('is_promotion')->default(false);
            $table->integer('promotion_value')->default(0);
            $table->date('voucher_date');
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
        Schema::dropIfExists('procedure_vouchers');
    }
};
