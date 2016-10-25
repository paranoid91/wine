<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules',function (Blueprint $table){
            $table->increments('id');
            $table->string('name',55)->unique();
            $table->string('controller',255);
            $table->enum('status',[0,1]);
            $table->integer('sort');
            $table->string('icon',55);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modules');
    }
}
