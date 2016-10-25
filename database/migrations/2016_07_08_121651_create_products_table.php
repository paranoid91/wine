<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('lang_id')->unsigned()->index();
            $table->integer('user_id')->unsigned();
            $table->string("title");
            $table->float("price");
            $table->float("extra_texas")->nullable();
            $table->float("rate")->nullable();
            $table->text("description");
            $table->text("delivery")->nullable();
            $table->text("serving_tips")->nullable();
            $table->char("lang",2);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}