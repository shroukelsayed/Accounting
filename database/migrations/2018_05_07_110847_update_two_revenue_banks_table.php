<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTwoRevenueBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('revenue_banks', function($table) {

            $table->integer('parent')->unsigned()->after('title');
            $table->foreign('parent')->references('id')->on('level_four_revenues')->onDelete('cascade');
            
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
        Schema::table('revenue_bank_accounts', function($table) {
            $table->dropColumn('parent');
        });
    }
}
