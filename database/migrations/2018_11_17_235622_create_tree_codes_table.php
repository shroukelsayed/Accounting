<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreeCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tree_codes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('level_title');
            $table->string('level_code');
            $table->integer('parent_id');
            $table->string('table_name');
            $table->integer('table_row_id');
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
        Schema::drop('tree_codes');

    }
}
