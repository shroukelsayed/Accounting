<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAccountSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_sheets', function($table) {

            $table->integer('registered_by')->unsigned();
            $table->integer('reviewed_by')->unsigned();
            $table->string('project_details');

            $table->foreign('registered_by')->references('id')->on('workers')->onDelete('cascade');

            $table->foreign('reviewed_by')->references('id')->on('workers')->onDelete('cascade');

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
    }
}
