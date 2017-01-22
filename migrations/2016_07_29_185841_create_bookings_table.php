<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
          $table->integer('viewer_id')->unsigned()->index();
          $table->integer('house_id')->unsigned()->index();
          $table->string('name', 15);
          $table->string('title', 100);
          $table->timestamp('start_time');
          $table->timestamp('end_time')->nullable;
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
        Schema::drop('bookings');
    }
}
