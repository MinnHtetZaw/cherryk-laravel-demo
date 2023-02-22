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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('name');
            $table->integer('age');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('occupation')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->text('drug_allergy')->nullable();
            $table->text('address');
            $table->enum('status',['customer','member'])->default('customer');
            $table->enum('level',[0,1,2,3,4,5,6,7])->default(0)->comment('1 to 7');
            $table->integer('visit_time')->default(0);
            $table->bigInteger('total_amount')->default(0);
            $table->bigInteger('credit_amount')->default(0);
            $table->boolean('is_member')->default(false);
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
        Schema::dropIfExists('customers');
    }
};
