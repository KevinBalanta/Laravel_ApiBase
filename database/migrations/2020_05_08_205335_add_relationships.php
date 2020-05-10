<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estates', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('estate_irrigation_systems', function (Blueprint $table) {
            $table->unsignedInteger('estate_id');
            $table->unsignedInteger('irrigation_system_id');
            $table->unsignedInteger('configuration_id');
            $table->foreign('estate_id')->references('id')->on('estates');
            $table->foreign('irrigation_system_id')->references('id')->on('irrigation_systems');
            $table->foreign('configuration_id')->references('id')->on('configurations');
            $table->unsignedInteger('irrigation_header_id');
            $table->foreign('irrigation_header_id')->references('id')->on('irrigation_headers');
        });

        Schema::table('drip_irrigation_modules', function (Blueprint $table) {
            $table->unsignedInteger('estate_irrigation_system_id');
            $table->foreign('estate_irrigation_system_id', 'estate_irrigation_system_fk_1428326')->references('id')->on('estate_irrigation_systems');
            $table->unsignedInteger('dropper_id')->nullable();
            $table->foreign('dropper_id', 'dropper_fk_1428327')->references('id')->on('droppers');
            $table->unsignedInteger('surco_separation_id');
            $table->foreign('surco_separation_id', 'surco_separation_fk_1439345')->references('id')->on('surcos_separations');
            $table->unsignedInteger('irrigation_id');
            $table->foreign('irrigation_id', 'irrigation_fk_1439618')->references('id')->on('irrigations');
        });

        Schema::table('drip_irrigation_operations', function (Blueprint $table) {
            $table->unsignedInteger('irrigation_module_id');
            $table->foreign('irrigation_module_id')->references('id')->on('drip_irrigation_modules');
        });

        Schema::table('calculated_attributes', function (Blueprint $table) {
            $table->unsignedInteger('indicator_id');
            $table->unsignedInteger('module_id');

            $table->foreign('indicator_id')->references('id')->on('indicators');
            $table->foreign('module_id')->references('id')->on('drip_irrigation_modules');
        });


        Schema::table('irrigation_headers', function (Blueprint $table) {
            $table->unsignedInteger('motorpump_id');
            $table->foreign('motorpump_id')->references('id')->on('motorpumps');
            $table->unsignedInteger('estate_id');
            $table->foreign('estate_id')->references('id')->on('estates');
            $table->unsignedInteger('water_source_id');
            $table->foreign('water_source_id')->references('id')->on('water_sources');
        });

        Schema::table('water_sources', function (Blueprint $table) {
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('water_source_types');
            $table->unsignedInteger('estate_id');
            $table->foreign('estate_id')->references('id')->on('estates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
