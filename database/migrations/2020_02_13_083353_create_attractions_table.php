<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attractions', function (Blueprint $table) {
          $table->integer('provinces_id');
          $table->increments('attractions_id');
          $table->string('attractions_name');
          $table->double('Latitude');
          $table->double('longitude');
          $table->longText('description');
          $table->string('image_url');
          $table->foreign('provinces_id')->references('provinces_id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attractions');
    }
}
