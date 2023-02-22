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
        Schema::create('procedure_treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('treatment_unit_id');
            $table->string('name');
            $table->integer('qty');
            $table->integer('price');
            $table->bigInteger('total_price');
            $table->longText('sig')->nullable();
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
        Schema::dropIfExists('procedure_treatments');
    }
};
