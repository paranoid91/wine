<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_inspection', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('inspection_id')->unsigned()->index();
            $table->foreign('inspection_id')->references('id')->on('auto_invoice')->onDelete('cascade');
            $table->integer('cat_id')->unsigned()->index();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cat_inspection');
    }
}
