<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('donation_receipts', function(Blueprint $table) {
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
            $table->string('donator_name');
            $table->string('donator_address');
            $table->integer('donator_mobile');
            $table->boolean('is_approved');
            $table->integer('project_id');
            $table->integer('receipt_writter_id');
            $table->integer('receipt_delegate_id');
            $table->integer('receipt_notebook');
            $table->integer('receipt_for_month');
            $table->integer('donation_section');
            $table->string('collecting_type');
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
        Schema::drop('donation_receipts');
    }
}
