<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers__customers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('customer_type');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender');
            $table->string('mail');
            $table->string('phone');
            $table->string('address');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('status');
            $table->string('custom_field1');
            $table->string('custom_field2');
            $table->string('custom_field3');
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
        Schema::dropIfExists('customers__customers');
    }
}
