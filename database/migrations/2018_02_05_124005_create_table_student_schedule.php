<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudentSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_schedule', function (Blueprint $table) {
            $table->increments('student_schedule');
            $table->unsignedInteger('student')->on('role')
                ->references('students');
            $table->unsignedInteger('schedule')->on('schedule')
                ->references('schedule');
            $table->unique(['student', 'schedule']);
            $table->string('status', 30);
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
        Schema::dropIfExists('student_schedule');
    }
}
