<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDicountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dicounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_name');
            $table->string('discount_type');
            $table->double('price');
            $table->date('promo_start_date');
            $table->date('promo_end_date');
            $table->string('promo_code');
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
        Schema::dropIfExists('dicounts');
    }
}
