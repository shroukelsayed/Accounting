<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStoreLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('store_logs', function($table) {
            $table->renameColumn('code','supplier_name');
            $table->renameColumn('title','supplier_address');
            $table->string('supplier_bill_number');
            $table->string('supply_order_number');
            $table->string('receipt_record_number');

            $table->integer('units_number');
            $table->double('unit_price');
            $table->double('total_units_price');

            $table->dropColumn('credit');
            $table->dropColumn('debit');
            $table->dropColumn('level');

            $table->integer('store_id')->unsigned();
            $table->integer('item_id')->unsigned();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('store_items')->onDelete('cascade');

            
            
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
