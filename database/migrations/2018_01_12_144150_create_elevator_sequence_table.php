<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevatorSequenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elevator_sequence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('interval');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('floor_start')->unsigned();
            $table->integer('floor_end')->unsigned();
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
        Schema::drop('elevator_sequence');
    }
}
