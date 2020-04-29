<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('application')->create('record_login', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->time('time')->default(DB::raw('CURRENT_TIME'));
            $table->ipAddress('ip_source');
            $table->string('php_session_id');
            $table->date('date_out')->nullable();
            $table->time('time_out')->nullable();
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_logins');
    }
}
