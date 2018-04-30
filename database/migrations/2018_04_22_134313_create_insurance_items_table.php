<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('insurance_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('social_insurance_id')->unsigned()->nullable();
            $table->foreign('social_insurance_id')->references('id')
                ->on('social_insurances')->onDelete('cascade');

            $table->integer('social_insurance_item_id')->unsigned()->nullable();
            $table->foreign('social_insurance_item_id')->references('id')
                ->on('social_insurance_items')->onDelete('cascade');

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
        Schema::drop('insurance_items');
    }
}
