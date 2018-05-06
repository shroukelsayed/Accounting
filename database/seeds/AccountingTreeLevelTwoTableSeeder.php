<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AccountingTreeLevelTwoTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        DB::table('accounting_tree_level_twos')->insert([
            'id' => 1 ,
            'code' => '11' ,
            'title' => 'اصول ثابتة' ,
            'accounting_tree_level_one_id' => 1 ,
            'level' => 2 ,
            'debit' => 0 ,
            'credit' => 1 ,
            'created_at' => '2018-04-04 09:42:52' ,
            'updated_at' => '2018-04-04 09:42:52' ,
        ]);

        DB::table('accounting_tree_level_twos')->insert([
            'id' => 2 ,
            'code' => '12',
            'title' => 'اصول متداولة' ,
            'accounting_tree_level_one_id' => 1 ,
            'level' => 2 ,
            'debit' => 0 ,
            'credit' => 1 ,
            'created_at' => '2018-04-04 09:43:29',
            'updated_at' => '2018-04-04 09:43:29',
        ]);

        DB::table('accounting_tree_level_twos')->insert([
            'id' => 3 ,
            'code' => '21',
            'title' => 'خصوم متداولة' ,
            'accounting_tree_level_one_id' => 2 ,
            'level' => 2 ,
            'debit' => 1 ,
            'credit' => 0 ,
            'created_at' => '2018-04-04 09:43:57' ,
            'updated_at' => '2018-04-04 09:43:57' ,
        ]);

        DB::table('accounting_tree_level_twos')->insert([
            'id' => 4,
            'code' => '31',
            'title' => 'مصروفات عمومية' ,
            'accounting_tree_level_one_id' => 3 ,
            'level' => 2 ,
            'debit' => 0 ,
            'credit' => 1 ,
            'created_at' => '2018-04-04 09:44:25' ,
            'updated_at' => '2018-04-04 09:44:25' ,
        ]);

        DB::table('accounting_tree_level_twos')->insert([
            'id' => 5,
            'code' => '32',
            'title' => 'مصروفات أنشطة',
            'accounting_tree_level_one_id' => 3,
            'level' =>2,
            'debit' => 0 ,
            'credit' => 1 ,
            'created_at' => '2018-04-04 09:44:42' ,
            'updated_at' => '2018-04-04 09:44:42' ,
        ]);
    }

}