<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('r_bank_accounts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            
            $table->integer('revenue_bank_id')->unsigned()->nullable();
            $table->foreign('revenue_bank_id')->references('id')
                ->on('revenue_banks')->onDelete('cascade');

            $table->integer('revenue_bank_account_id')->unsigned()->nullable();
            $table->foreign('revenue_bank_account_id')->references('id')
                ->on('revenue_bank_accounts')->onDelete('cascade');

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
        Schema::drop('r_bank_accounts');
    }
}
