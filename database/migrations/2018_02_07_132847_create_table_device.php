<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('devices');
            $table->string('name', 255);
            $table->integer('seat')->foreign('seat')->references('seat')->on('seat');
            $table->integer('room')->foreign('room')->references('room')->on('room');
            $table->string('sticker')->nullable();
            $table->string('brand')->nullable();
            $table->string('serial')->nullable();
            $table->dateTime('end_of_life', 255)->nullable();
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
        Schema::dropIfExists('device');
    }
}
