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
        Schema::create('supplier_credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('supplier_id');
            $table->bigInteger('credit_amount');
            $table->enum('status',[0,1,2])->comment('0 is unpaid, 1 is partial, 2 is paid');
            $table->date('repay_date')->nullable();
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
        Schema::dropIfExists('supplier_credits');
    }
};
