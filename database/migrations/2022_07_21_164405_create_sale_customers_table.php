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
        Schema::create('sale_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('member_status',['0', '1'])->default(0);
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('procedure_id');
            $table->integer('procedure_time');
            $table->integer('visit_time');
            $table->integer('credit_amount');
            $table->integer('procedure_total_amount');
            $table->integer('medicine_total_amount');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('promotion_id')->nullable();
            $table->date('last_purchase_date')->nullable();
            $table->date('last_appointment_date')->nullable();
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
        Schema::dropIfExists('sale_customers');
    }
};
