<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->text('number')->nullable();
            $table->text('postcode');
            $table->text('address')->nullable();
            $table->text('address_first_line')->nullable();
            $table->text('address_second_line')->nullable();
            $table->text('address_third_line')->nullable();
            $table->text('address_forth_line')->nullable();
            $table->text('address_locality')->nullable();
            $table->text('address_town')->nullable();
            $table->text('address_county')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
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
        Schema::drop('houses');
    }
}
