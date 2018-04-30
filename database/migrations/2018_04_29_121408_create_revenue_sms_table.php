<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenueSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('revenue_sms', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('title');
            $table->integer('parent')->unsigned();
            $table->integer('level');
            $table->boolean('debit');
            $table->boolean('credit');

            $table->foreign('parent')->references('id')->on('level_four_revenues')->onDelete('cascade');
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
        //
        Schema::drop('revenue_sms');
    }
}
