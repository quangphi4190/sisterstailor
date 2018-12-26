<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostManagecategorysTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post__managecategorys_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('managecategorys_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['managecategorys_id', 'locale']);
            $table->foreign('managecategorys_id')->references('id')->on('post__managecategorys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post__managecategorys_translations', function (Blueprint $table) {
            $table->dropForeign(['managecategorys_id']);
        });
        Schema::dropIfExists('post__managecategorys_translations');
    }
}
