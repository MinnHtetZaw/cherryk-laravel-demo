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
        Schema::create('treatment_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatment_id');
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('est_cost');
            $table->integer('per_unit_qty')->default(1);

            $table->integer('selling_price');
            $table->enum('status',['available','non-available'])->default('available');
            $table->string('photo')->nullable();
            $table->string('tag');
            $table->integer('count')->default(0);
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
        Schema::dropIfExists('treatment_units');
    }
};
