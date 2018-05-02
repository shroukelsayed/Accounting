<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('currencies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->float('rate');
            
            $table->integer('treasury_id')->unsigned()->nullable();
            $table->foreign('treasury_id')->references('id')
                ->on('treasuries')->onDelete('cascade');

            $table->integer('treasury_currency_id')->unsigned()->nullable();
            $table->foreign('treasury_currency_id')->references('id')
                ->on('treasury_currencies')->onDelete('cascade');

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
        Schema::drop('currencies');
    }
}
