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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
             $table->string('title');
            $table->string('patient_name');
            $table->integer('patient_status')->default(0);
            $table->string('old_customer_id')->nullable();
            $table->string('doctor_name');
            $table->string('date')->nullable();
            $table->longText('description')->nullable();
            $table->string('phone');
            $table->string('time');
            $table->string('end')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
