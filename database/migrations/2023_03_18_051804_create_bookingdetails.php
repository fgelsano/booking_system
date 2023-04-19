<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookingdetails', function (Blueprint $table) {
            $table->id();
            // $table->integer('profile_id')->unsigned();
            // $table->integer('accommodation_id')->unsigned();
            // $table->integer('discount_id')->unsigned();
            $table->string('passengertype');
            $table->integer('vat');
            // $table->foreign('profile_id')->references('id')->on('profiles');
            // $table->foreign('accommodation_id')->references('id')->on('accommodations');
            // $table->foreign('discount_id')->references('id')->on('dicounts');
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
        Schema::dropIfExists('bookingdetails');
    }
}
