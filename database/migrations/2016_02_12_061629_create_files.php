<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',100);
            $table->string('file_path');
            $table->string('cloud_id',32);
            $table->char('ext',4);
            $table->string('hash',32);
            $table->enum('type',['image','video']);
            $table->enum('status',[0,1,2])->comment = "0 simple, 1 main";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('files');
    }
}
