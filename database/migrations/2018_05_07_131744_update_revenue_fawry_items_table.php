<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRevenueFawryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        //
        Schema::table('revenue_fawry_items', function($table) {

            $table->dropColumn('debit');
            $table->dropColumn('credit');

            $table->integer('revenue_fawry_id')->unsigned()->nullable();
            $table->foreign('revenue_fawry_id')->references('id')
                ->on('revenue_fawries')->onDelete('cascade');

            $table->integer('level_four_revenue_id')->unsigned()->nullable();
            $table->foreign('level_four_revenue_id')->references('id')
                ->on('level_four_revenues')->onDelete('cascade');

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
        Schema::table('revenue_fawry_items', function($table) {
            $table->dropColumn('revenue_fawry_id');
            $table->dropColumn('level_four_revenue_id');
        });
    }
}
