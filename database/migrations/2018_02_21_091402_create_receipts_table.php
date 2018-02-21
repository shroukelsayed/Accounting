<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('receipts', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('cash');
            $table->double('amount', 15, 8);
            $table->string('alpha_amount');
            $table->string('notes');
            $table->tinyInteger('type');
            $table->dateTime('receipt_date');
            $table->bigInteger('cheque_number');
            $table->string('cheque_bank');
            $table->dateTime('cheque_date');
            $table->string('for_account');
            $table->integer('user_id');
            
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
        Schema::drop('receipts');

    }
}
