<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AccountingTreeLevelOneTableSeeder extends Seeder {

    public function run()
    {
        DB::table('accounting_tree_level_ones')->insert([
            'id' => 1 ,
            'code' => '1' ,
            'title' => 'الاصول' ,
            'level' => 1 ,
            'debit' => 0 ,
            'credit' => 1 ,
            'created_at' => '2018-04-04 09:42:52' ,
            'updated_at' => '2018-04-04 09:42:52' ,
        ]);

        DB::table('accounting_tree_level_ones')->insert([
            'id' => 1 ,
            'code' => '2' ,
            'title' => 'الخصوم' ,
            'level' => 1 ,
            'debit' => 1 ,
            'credit' => 0 ,
            'created_at' => '2018-04-04 09:42:52' ,
            'updated_at' => '2018-04-04 09:42:52' ,
        ]);

        DB::table('accounting_tree_level_ones')->insert([
            'id' => 1 ,
            'code' => '3' ,
            'title' => 'المصروفات' ,
            'level' => 1 ,
            'debit' => 0 ,
            'credit' => 1 ,
            'created_at' => '2018-04-04 09:42:52' ,
            'updated_at' => '2018-04-04 09:42:52' ,
        ]);

        DB::table('accounting_tree_level_ones')->insert([
            'id' => 1 ,
            'code' => '4' ,
            'title' => 'الإيرادات' ,
            'level' => 1 ,
            'debit' => 1 ,
            'credit' => 0 ,
            'created_at' => '2018-04-04 09:42:52' ,
            'updated_at' => '2018-04-04 09:42:52' ,
        ]);

        
    }

}

