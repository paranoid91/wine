<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services',function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('lang_id')->unsigned();
            $table->string('title');
            $table->text('text');
            $table->string('poster');
            $table->enum('lang',['en','cn']);
            $table->enum('is_publish',[0,1]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
    }
}
