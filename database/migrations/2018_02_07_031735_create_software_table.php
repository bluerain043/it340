<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->increments('software');
            $table->string('name')->nullable();
            $table->integer('seat')->foreign('seat')->references('seat')->on('seat');
            $table->integer('room')->foreign('room')->references('room')->on('room');
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('end_of_life')->nullable();
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
        Schema::dropIfExists('software');
    }
}
