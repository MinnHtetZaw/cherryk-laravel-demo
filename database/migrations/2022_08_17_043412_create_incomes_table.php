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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type',[1,2])->comment('1 is Fixed & 2 is Variable');
            $table->enum('period',[1,2,3])->comment('1 is Daily & 2 is Weekly & 3 is Monthly')->nullable();
            $table->text('description')->nullable();
            $table->integer('amount');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('incomes');
    }
};
