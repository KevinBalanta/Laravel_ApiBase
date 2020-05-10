<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDroppersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('droppers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('flow', 3, 3);
            $table->float('separation', 4, 3);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('dropper_type_id');

            $table->foreign('dropper_type_id')->references('id')->on('dropper_types');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('droppers');
    }
}
