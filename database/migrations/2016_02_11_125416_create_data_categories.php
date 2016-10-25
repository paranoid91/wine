<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_data', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('data_id')->unsigned()->index();
            $table->foreign('data_id')->references('id')->on('data')->onDelete('cascade');
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
        Schema::drop('cat_data');
    }
}
