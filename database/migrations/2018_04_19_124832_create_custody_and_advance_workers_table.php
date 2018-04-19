<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustodyAndAdvanceWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('custody_and_advance_workers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('custody_and_advance_id')->unsigned()->nullable();
            $table->foreign('custody_and_advance_id')->references('id')
                ->on('custody_and_advances')->onDelete('cascade');

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
        Schema::drop('custody_and_advance_workers');
    }
}
