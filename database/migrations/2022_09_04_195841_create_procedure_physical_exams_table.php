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
        Schema::create('procedure_physical_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('physical_exam_id');
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
        Schema::dropIfExists('procedure_physical_exams');
    }
};
