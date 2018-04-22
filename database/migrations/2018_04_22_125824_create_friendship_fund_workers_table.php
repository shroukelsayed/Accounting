<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendshipFundWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('friendship_fund_workers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('friendship_fund_id')->unsigned()->nullable();
            $table->foreign('friendship_fund_id')->references('id')
                ->on('friendship_funds')->onDelete('cascade');

            $table->integer('worker_id')->unsigned()->nullable();
            $table->foreign('worker_id')->references('id')
                ->on('workers')->onDelete('cascade');

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
        Schema::drop('friendship_fund_workers');
    }
}
