<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void!
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('devices');
            $table->integer('students')->unsiqned();
            $table->integer('seat_number')->unsigned();
            $table->string('name')->nullable();
            $table->string('sticker')->nullable();
            $table->string('brand')->nullable();
            $table->string('serial')->nullable();
            $table->foreign('students')->references('students')->on('students');
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
        Schema::dropIfExists('devices');
    }
}
