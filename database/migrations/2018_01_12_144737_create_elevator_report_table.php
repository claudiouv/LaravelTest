<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevatorReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elevator_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('elevator_sequence_id')->unsigned();
            $table->integer('elevator_number')->unsigned();
            $table->string('time');
            $table->integer('start_floor')->unsigned();
            $table->integer('end_floor')->unsigned();
            $table->integer('floor_moves')->unsigned();
            $table->softDeletes();
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
        Schema::drop('elevator_report');
    }
}
