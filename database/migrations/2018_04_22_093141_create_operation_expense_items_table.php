<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationExpenseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('operation_expense_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('operation_expense_id')->unsigned()->nullable();
            $table->foreign('operation_expense_id')->references('id')
                ->on('level_four_operation_expenses')->onDelete('cascade');

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
        Schema::drop('operation_expense_items');
    }
}
