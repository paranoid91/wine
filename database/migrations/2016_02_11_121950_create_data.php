<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data',function(Blueprint $table){
            $table->increments('id');
            $table->integer('lang_id')->unsigned()->index();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('desc');
            $table->longText('text');
            $table->text('extra_fields');
            $table->string('slug');
            $table->string('meta_description',100);
            $table->string('meta_keywords',100);
            $table->char('lang',2);
            $table->enum('main',[0,1])->comment = "0 default, 1 main post";
            $table->enum('status',[0,1,2,3])->comment = "0 unpublished, 1 published";
            $table->timestamps();
            $table->timestamp('published_at');
            $table->timestamp('finished_at');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('data');
    }
}
