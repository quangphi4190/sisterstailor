<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourGuideTourGuideTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourguide__tourguide_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('tourguide_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['tourguide_id', 'locale']);
            $table->foreign('tourguide_id')->references('id')->on('tourguide__tourguides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tourguide__tourguide_translations', function (Blueprint $table) {
            $table->dropForeign(['tourguide_id']);
        });
        Schema::dropIfExists('tourguide__tourguide_translations');
    }
}
