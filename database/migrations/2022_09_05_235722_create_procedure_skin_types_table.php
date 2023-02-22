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
        Schema::create('procedure_skin_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('skin_type_id');
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('procedure_skin_types');
    }
};
