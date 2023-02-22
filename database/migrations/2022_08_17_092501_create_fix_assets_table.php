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
        Schema::create('fix_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type',['Home','Vehicle','Machinery']);
            $table->integer('purchase_initial');
            $table->integer('salvage');
            $table->integer('use_life');
            $table->integer('yearly_depreciation');
            $table->integer('month_depreciation');
            $table->integer('used_year')->nullable();
            $table->integer('remaining_year')->nullable();
            $table->integer('total_depreciation')->nullable();
//            $table->integer('current_price');
            $table->date('start_date');
            $table->date('future_date');
            $table->enum('sell_end_type',['Sell','End']);
            $table->integer('sell_price')->default(0);
            $table->date('sell_date')->nullable();
            $table->integer('profit_loss_value')->default(0);
            $table->date('end_date')->nullable();
            $table->text('end_remark')->nullable();
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
        Schema::dropIfExists('fix_assets');
    }
};
