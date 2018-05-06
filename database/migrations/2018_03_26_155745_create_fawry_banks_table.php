<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFawryBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fawry_banks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('title');
            $table->integer('level');
            $table->boolean('debit');
            $table->boolean('credit');

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
        Schema::drop('fawry_banks');
    }
}
