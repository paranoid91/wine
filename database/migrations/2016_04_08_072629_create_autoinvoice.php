<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoinvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_invoice',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('receipted_at');
            $table->timestamp('executed_at');
            $table->char('registration_number',10);
            $table->string('vincode',32);
            $table->date('year');
            $table->integer('mileage')->unsigned();
            $table->char('engine_volume',4);
            $table->enum('length',[0,1]);
            $table->enum('law',[0,1,2]);
            $table->string('owner',55);
            $table->string('phone',20);
            $table->char('personal_id',11);
            $table->text('total');
            $table->binary('extra');
            $table->timestamps();
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
        Schema::drop('auto_invoice');
    }
}
