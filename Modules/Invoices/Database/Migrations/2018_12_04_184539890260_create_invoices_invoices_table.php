<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices__invoices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('tour_guide_id');
            $table->integer('hotel_id');
            $table->dateTime('order_date');
            $table->string('product');
            $table->integer('price');
            $table->string('discount');
            $table->string('payment_type');
            $table->dateTime('delivery_date');
            $table->string('delivery_address');
            $table->string('delivery_name');
            $table->string('delivery_phone');
            $table->text('delivery_note');
            $table->string('billing_name');
            $table->string('billing_phone');
            $table->string('status');
            $table->text('note');
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
        Schema::dropIfExists('invoices__invoices');
    }
}
