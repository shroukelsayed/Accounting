<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFawryFawryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('fawry_fawry_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('fawry_id')->unsigned()->nullable();
            $table->foreign('fawry_id')->references('id')
                ->on('fawries')->onDelete('cascade');

            $table->integer('fawry_item_id')->unsigned()->nullable();
            $table->foreign('fawry_item_id')->references('id')
                ->on('fawry_items')->onDelete('cascade');

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
        Schema::drop('fawry_fawry_items');

    }
}
