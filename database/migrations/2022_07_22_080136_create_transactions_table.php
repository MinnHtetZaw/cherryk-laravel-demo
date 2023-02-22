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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('procedure_id');
            $table->unsignedBigInteger('procedure_treatment_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('payment_type')->nullable();
            $table->date('payment_date');
            $table->bigInteger('total_amount')->default(0);
            $table->bigInteger('pay_amount')->default(0);
            $table->bigInteger('collect_amount')->default(0);
            $table->string('bank_account')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
