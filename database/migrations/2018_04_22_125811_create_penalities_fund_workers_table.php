<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenalitiesFundWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('penalities_fund_workers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('penalities_fund_id')->unsigned()->nullable();
            $table->foreign('penalities_fund_id')->references('id')
                ->on('penalities_funds')->onDelete('cascade');

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
        Schema::drop('penalities_fund_workers');
    }
}
