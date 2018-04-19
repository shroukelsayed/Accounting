<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccuredItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('accured_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('accured_revenue_id')->unsigned()->nullable();
            $table->foreign('accured_revenue_id')->references('id')
                ->on('accured_revenues')->onDelete('cascade');

            $table->integer('accured_revenues_item_id')->unsigned()->nullable();
            $table->foreign('accured_revenues_item_id')->references('id')
                ->on('accured_revenues_items')->onDelete('cascade');

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
    }
}
