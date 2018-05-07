<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRevenueBanksTable extends Migration
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
            $table->dropForeign('revenue_banks_parent_foreign');
            $table->dropColumn('parent');
        });
    }

}
