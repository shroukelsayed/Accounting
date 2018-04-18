<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('account_items', function(Blueprint $table)
        {
            $table->increments('id');
            
            $table->integer('bank_account_id')->unsigned()->nullable();
            $table->foreign('bank_account_id')->references('id')
                ->on('bank_accounts')->onDelete('cascade');

            $table->integer('bank_account_item_id')->unsigned()->nullable();
            $table->foreign('bank_account_item_id')->references('id')
                ->on('bank_account_items')->onDelete('cascade');

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
        Schema::drop('account_items');
        
    }
}
