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
            $table->increments('id');
            $table->string('photo');
            $table->string('studno');
            $table->integer('batch');
            $table->string('fname');
            $table->string('lname');
            $table->date('bday');
            $table->integer('age');
            $table->string('jobexp');
            $table->bigInteger('contact');
            $table->string('email');
            $table->string('attainment');
            $table->string('school');
            $table->string('nickname');
            $table->time('sched_in');
            $table->time('sched_out');
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
