<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsAdvertisementTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements__advertisement_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('advertisement_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['advertisement_id', 'locale']);
            $table->foreign('advertisement_id')->references('id')->on('advertisements__advertisements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisements__advertisement_translations', function (Blueprint $table) {
            $table->dropForeign(['advertisement_id']);
        });
        Schema::dropIfExists('advertisements__advertisement_translations');
    }
}
