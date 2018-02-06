<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpecifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->increments('specifications');
            $table->integer('students')->references('students')->on('students');
            $table->string('processor', 255)->nullable();
            $table->string('memory', 255)->nullable();
            $table->string('board', 255)->nullable();
            $table->string('hdd', 255)->nullable();
            $table->string('graphics_card', 255)->nullable();
            $table->string('end_of_life', 255)->nullable();
            $table->text('others')->nullable();
            $table->text('in_used')->nullable();
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
        Schema::dropIfExists('specifications');
    }
}
