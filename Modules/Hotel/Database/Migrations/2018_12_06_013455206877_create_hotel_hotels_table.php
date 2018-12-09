<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel__hotels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->text('contact_name');
            $table->text('contact_phone');
            $table->text('contact_mail');
            $table->text('status');
            // Your fields
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();            
            $table->integer('city_id')->unsigned();      

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
        Schema::dropIfExists('hotel__hotels');
    }
}
