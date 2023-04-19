<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            // $table->id();
            // // $table->integer('accomodation_id')->unsigned();
            // $table->string('vessel_name');
            // $table->integer('vessel_capacity');
            // // $table->foreign('accomodation_id')->references('id')->on('accomodations')->onDelete('cascade');
            // $table->timestamps();
            $table->id();
            $table->string('vessel_name');
            $table->integer('vessel_capacity');
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
        Schema::dropIfExists('vessels');
    }
}
