<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvancedExpensesExpensesItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('advanced_expense_expenses_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('advanced_expense_id')->unsigned()->nullable();
            $table->foreign('advanced_expense_id')->references('id')
                ->on('advanced_expenses')->onDelete('cascade');

            $table->integer('expenses_item_id')->unsigned()->nullable();
            $table->foreign('expenses_item_id')->references('id')
                ->on('expenses_items')->onDelete('cascade');

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
        Schema::drop('advanced_expense_expenses_items');
    }
}
