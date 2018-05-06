<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustodySheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('custody_sheets', function(Blueprint $table) {
            $table->increments('id');
            $table->string('notes');
            $table->string('report');
            $table->double('amount', 15, 8);
            $table->dateTime('custody_date');
            $table->integer('worker_id');
            $table->tinyInteger('type');

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
        // Schema::drop('custody_sheets');
    }
}
