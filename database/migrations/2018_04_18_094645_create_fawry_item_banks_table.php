<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFawryItemBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fawry_item_banks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
           
            $table->integer('fawry_item_id')->unsigned()->nullable();
            $table->foreign('fawry_item_id')->references('id')
                ->on('fawry_fawry_items')->onDelete('cascade');

            $table->integer('fawry_bank_id')->unsigned()->nullable();
            $table->foreign('fawry_bank_id')->references('id')
                ->on('fawry_banks')->onDelete('cascade');

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
        Schema::drop('fawry_item_banks');

    }
}
