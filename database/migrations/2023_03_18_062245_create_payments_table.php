<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->integer('profile_id')->unsigned();
            // $table->integer('booking_id')->unsigned();
            // $table->integer('discount_id')->unsigned();
            $table->double('amount');
            $table->tinyInteger('status')->comment('0=unpaid, 1=paid')->default(0);
            // $table->foreign('profile_id')->references('id')->on('profiles');
            // $table->foreign('booking_id')->references('id')->on('bookings');
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
        Schema::dropIfExists('payments');
    }
}
