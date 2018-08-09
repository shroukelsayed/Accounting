<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLevelTwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('accounting_tree_level_twos', function($table) {
            $table->renameColumn('accounting_tree_level_one_id','parent');
            $table->integer('parent')->unsigned()->change();
            $table->foreign('parent')->references('id')->on('accounting_tree_level_ones')->onDelete('cascade');
            
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

        Schema::table('accounting_tree_level_twos', function($table) {
            $table->dropColumn('parent');
        });
    }
}
