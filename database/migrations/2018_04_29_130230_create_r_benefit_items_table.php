<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRBenefitItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('r_benefit_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('revenue_benefit_id')->unsigned()->nullable();
            $table->foreign('revenue_benefit_id')->references('id')
                ->on('revenue_benefits')->onDelete('cascade');

            $table->integer('revenue_benefit_item_id')->unsigned()->nullable();
            $table->foreign('revenue_benefit_item_id')->references('id')
                ->on('revenue_benefit_items')->onDelete('cascade');

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
        Schema::drop('r_benefit_items');
    }
}
