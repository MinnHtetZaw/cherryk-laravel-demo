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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id');
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->longText('drug_his')->nullable();
            $table->longText('medical_his')->nullable();
            $table->longText('allergy_his')->nullable();
            $table->longText('treatment_his')->nullable();
            $table->longText('complain')->nullable();
            $table->longText('diagnosis')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->longText('prescription')->nullable();
            $table->longText('other_physical_exam')->nullable();
            $table->bigInteger('consultation_charges')->default(0);
            $table->bigInteger('service_charges')->default(0);
            $table->enum('status',['uncheck','check'])->default('uncheck');
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
        Schema::dropIfExists('procedures');
    }
};
