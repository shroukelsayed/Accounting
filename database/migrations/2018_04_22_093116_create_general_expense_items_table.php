<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralExpenseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('general_expense_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('general_expense_id')->unsigned()->nullable();
            $table->foreign('general_expense_id')->references('id')
                ->on('level_four_general_expenses')->onDelete('cascade');

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
        Schema::drop('general_expense_items');
    }
}
