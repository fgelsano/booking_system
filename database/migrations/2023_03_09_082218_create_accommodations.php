<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vessel_id');
            // $table->integer('fare_id')->unsigned();
            $table->string('accommodation_name');
            $table->string('image_path')->nullable();
            // $table->string('accommodation_type');
            $table->integer('cottage_qy')->default(0);
            // $table->foreign('fare_id')->references('id')->on('fares')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
}
