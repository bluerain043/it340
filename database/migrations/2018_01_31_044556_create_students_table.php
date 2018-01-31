<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('students');
            $table->string('seat_number', 16)->nullable();
            $table->string('student_name')->nullable();
            $table->string('department')->nullable();
            $table->string('course')->nullable();
            $table->integer('year')->nullable();
            $table->integer('pos_x')->nullable();
            $table->integer('pos_y')->nullable();
            $table->integer('room')->foreign('room')->references('room')->on('room');
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
        Schema::dropIfExists('students');
    }
}
