<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesInvoiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices__invoice_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('invoice_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['invoice_id', 'locale']);
            $table->foreign('invoice_id')->references('id')->on('invoices__invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices__invoice_translations', function (Blueprint $table) {
            $table->dropForeign(['invoice_id']);
        });
        Schema::dropIfExists('invoices__invoice_translations');
    }
}
