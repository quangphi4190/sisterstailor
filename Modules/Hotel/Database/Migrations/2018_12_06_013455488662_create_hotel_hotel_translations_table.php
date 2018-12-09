<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelHotelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel__hotel_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('hotel_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['hotel_id', 'locale']);
            $table->foreign('hotel_id')->references('id')->on('hotel__hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel__hotel_translations', function (Blueprint $table) {
            $table->dropForeign(['hotel_id']);
        });
        Schema::dropIfExists('hotel__hotel_translations');
    }
}
