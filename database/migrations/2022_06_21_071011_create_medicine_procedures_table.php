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
        Schema::create('medicine_procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->string('name');
            $table->integer('qty');
            $table->integer('selling_price');
            $table->string('dose')->nullable();
            $table->bigInteger('total_price');
            $table->bigInteger('day')->default(1);
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
        Schema::dropIfExists('medicine_procedures');
    }
};
