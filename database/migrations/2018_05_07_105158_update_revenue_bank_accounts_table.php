<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRevenueBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('revenue_bank_accounts', function($table) {

            $table->dropForeign('revenue_bank_accounts_parent_foreign');
            $table->dropColumn('parent');
            $table->dropColumn('debit');
            $table->dropColumn('credit');

            $table->integer('revenue_bank_id')->unsigned()->nullable();
            $table->foreign('revenue_bank_id')->references('id')
                ->on('revenue_banks')->onDelete('cascade');

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
        Schema::table('revenue_bank_accounts', function($table) {
            $table->dropColumn('revenue_bank_id');
            $table->dropColumn('level_four_revenue_id');
        });
    }
}
