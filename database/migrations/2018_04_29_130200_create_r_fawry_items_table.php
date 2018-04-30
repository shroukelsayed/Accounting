<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRFawryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('r_fawry_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('revenue_fawry_id')->unsigned()->nullable();
            $table->foreign('revenue_fawry_id')->references('id')
                ->on('revenue_fawries')->onDelete('cascade');

            $table->integer('revenue_fawry_item_id')->unsigned()->nullable();
            $table->foreign('revenue_fawry_item_id')->references('id')
                ->on('revenue_fawry_items')->onDelete('cascade');

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
        Schema::drop('r_fawry_items');
    }
}
