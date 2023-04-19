<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('user_id')->unsigned();
            // $table->integer('staff_id')->unsigned();
            // $table->integer('customer_id')->unsigned();
            // $table->integer('bookingdetails_id')->unsigned();
            // $table->integer('schedule_id')->unsigned();
            $table->string('status');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('staff_id')->references('id')->on('profiles')->onDelete('cascade');
            // $table->foreign('customer_id')->references('id')->on('profiles')->onDelete('cascade');
            // $table->foreign('bookingdetails_id')->references('id')->on('bookingdetails')->onDelete('cascade');
            // $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
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
        Schema::dropIfExists('bookings');
    }
}
