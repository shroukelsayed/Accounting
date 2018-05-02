<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('treasury_currencies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('title');
            $table->string('currency_code');
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
        Schema::drop('treasury_currencies');
    }
}
