<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccuredExpenseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         //
        Schema::create('accured_expense_items', function(Blueprint $table)
        {
            $table->integer('accured_expense_id')->unsigned()->nullable();
            $table->foreign('accured_expense_id')->references('id')
                ->on('accured_expenses')->onDelete('cascade');

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
        Schema::drop('accured_expense_items');
    }
}
