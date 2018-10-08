<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class CustodyAndAdvancesTableSeeder extends Seeder {

    public function run()
    {

    
         DB::table('custody_and_advances')->insert([
            'id' => '1',
            'code' => '120501',
            'title' => 'عهد عاملين ',
            'parent' => '5',
            'level' => '4',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-22 13:21:32',
            'updated_at' => '2018-04-22 13:21:32',
        ]);

         DB::table('custody_and_advances')->insert([
            'id' => '2',
            'code' => '120502',
            'title' => 'سلف عاملين ',
            'parent' => '5',
            'level' => '4',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-22 13:21:50',
            'updated_at' => '2018-04-22 13:21:50',
        ]);

    }

}
