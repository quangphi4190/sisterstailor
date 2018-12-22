<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsCategoriesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products__categories_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('categories_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['categories_id', 'locale']);
            $table->foreign('categories_id')->references('id')->on('products__categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products__categories_translations', function (Blueprint $table) {
            $table->dropForeign(['categories_id']);
        });
        Schema::dropIfExists('products__categories_translations');
    }
}
