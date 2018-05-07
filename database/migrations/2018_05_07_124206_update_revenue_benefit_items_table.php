<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRevenueBenefitItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('revenue_benefit_items', function($table) {

            $table->dropColumn('debit');
            $table->dropColumn('credit');

            $table->integer('revenue_benefit_id')->unsigned()->nullable();
            $table->foreign('revenue_benefit_id')->references('id')
                ->on('revenue_benefits')->onDelete('cascade');

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
        Schema::table('revenue_benefit_items', function($table) {
            $table->dropColumn('revenue_benefit_id');
            $table->dropColumn('level_four_revenue_id');
        });
    }
}
