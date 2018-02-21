<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('account_sheets', function(Blueprint $table) {
            $table->increments('id');
            $table->string('sheet_number');
            $table->dateTime('sheet_date');
            $table->tinyInteger('type');
            $table->integer('currency_id');
            $table->boolean('debit');
            $table->boolean('credit');
            $table->double('credit_amount', 15, 8);
            $table->double('debit_amount', 15, 8);
            $table->string('alpha_amount');
            $table->string('report');
            $table->integer('user_id');
            $table->integer('from_account');
            $table->integer('to_account');
            $table->integer('donation_section');

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
        Schema::drop('account_sheets');
    }
}
