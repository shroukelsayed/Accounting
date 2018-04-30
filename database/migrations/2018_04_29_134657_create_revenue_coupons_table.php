<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenueCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('revenue_coupons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('level_four_revenue_id')->unsigned()->nullable();
            $table->foreign('level_four_revenue_id')->references('id')
                ->on('level_four_revenues')->onDelete('cascade');
            
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->foreign('coupon_id')->references('id')
                ->on('coupons')->onDelete('cascade');

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
        Schema::drop('revenue_coupons');
    }
}
