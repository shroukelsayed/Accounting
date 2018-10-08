<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class TreasuriesTableSeeder extends Seeder {

    public function run()
    {

        DB::table('treasuries')->insert([
            'id' => '1',
            'code' => '120101',
            'title' => 'خزينة تبرعات',
            'parent' => '1',
            'level' => '4',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-05-02 11:46:43',
            'updated_at' => '2018-05-02 11:46:43',
        ]);

        DB::table('treasuries')->insert([
            'id' => '2',
            'code' => '120102',
            'title' => 'خزينة سلفة',
            'parent' => '1',
            'level' => '4',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-05-02 11:46:58',
            'updated_at' => '2018-05-02 11:46:58',
        ]);


    }

}
