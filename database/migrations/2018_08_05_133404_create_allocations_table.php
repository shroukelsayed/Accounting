<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('allocations', function(Blueprint $table) {
            $table->increments('id');
            // $table->string('code');
            $table->string('title');
            // $table->integer('parent')->unsigned();
            $table->integer('level');
            $table->double('amount');
            $table->boolean('debit');
            $table->boolean('credit');

            // $table->foreign('parent')->references('id')->on('accured_revenues_fawries')->onDelete('cascade');
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
        Schema::drop('allocations');
    }
}
