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

            $table->integer('tour_guide_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['tour_guide_id', 'locale']);
            $table->foreign('tour_guide_id')->references('id')->on('tourguide__tourguides')->onDelete('cascade');
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
            $table->dropForeign(['tour_guide_id']);
        });
        Schema::dropIfExists('tourguide__tourguide_translations');
    }
}
