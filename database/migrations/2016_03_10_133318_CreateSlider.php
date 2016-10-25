<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider',function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('sub_title',100);
            $table->string('poster');
            $table->string('link');
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
        Schema::drop('slider');
    }
}
