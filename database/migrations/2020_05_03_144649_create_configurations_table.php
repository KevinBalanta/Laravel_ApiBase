<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('minimum_tension')->default(0);
            $table->integer('maximum_tension')->default(80);
            $table->integer('minimum_level_water')->default(20);
            $table->integer('maximum_level_water')->default(100);
            $table->time('start_time')->default('07:00:00');
            $table->time('end_time')->default('17:00:00');
            $table->float('lamina', 3, 3)->default(1);
            $table->softDeletes();

            $table->timestamps();

            //relación con state irrigation system
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
