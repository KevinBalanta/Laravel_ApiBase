<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDripIrrigationOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drip_irrigation_operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('tension', 2, 3);
            $table->string('mesocosmo');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('action_id');
            
            $table->foreign('action_id')->references('id')->on('actions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drip_irrigation_operations');
    }
}
