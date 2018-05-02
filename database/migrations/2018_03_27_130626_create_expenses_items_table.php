<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('expenses_items', function(Blueprint $table) {
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
        Schema::drop('expenses_items');
    }
}
