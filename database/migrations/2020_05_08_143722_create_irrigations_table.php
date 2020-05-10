<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrrigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irrigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount_hours');
            $table->integer('frequency_days');
            $table->integer('amount_minutes');
            $table->unsignedInteger('strategy_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('strategy_id')->references('id')->on('irrigation_strategies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irrigations');
    }
}
