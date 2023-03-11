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
            $table->increments('id');
            $table->unsignedInteger('profile_id')->unsigned();
            $table->unsignedInteger('staff_id')->unsigned();
            $table->unsignedInteger('customer_id')->unsigned();
            $table->unsignedInteger('accomodation_id')->unsigned();
            $table->unsignedInteger('discount_id')->unsigned();
            $table->integer('vat');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('staff_id')->references('id')->on('profiles');
            $table->foreign('customer_id')->references('id')->on('profiles');
            $table->foreign('accomodation_id')->references('id')->on('accomodations');
            $table->foreign('discount_id')->references('id')->on('discounts');
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
