<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPostcategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post__postcategory_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('postcategory_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['postcategory_id', 'locale']);
            $table->foreign('postcategory_id')->references('id')->on('post__postcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post__postcategory_translations', function (Blueprint $table) {
            $table->dropForeign(['postcategory_id']);
        });
        Schema::dropIfExists('post__postcategory_translations');
    }
}
