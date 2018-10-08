<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class LevelThreeRevenuesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('level_three_revenues')->insert([
        	'id' => '1',
        	'code' => '4101',
        	'title' => 'ايرادات  فوائد الودائع البنك التجاري الدولي ',
        	'parent' => '6',
        	'level' => '3',
        	'debit' => '1',
        	'credit' => '0',
        	'created_at' => '2018-07-19 14:47:16',
        	'updated_at' => '2018-07-19 14:47:16',
        ]);
        DB::table('level_three_revenues')->insert([
        	'id' => '2',
        	'code' => '4102',
        	'title' => 'ايرادات  فوائد الوائع البنك المصرف المتحد ',
        	'parent' => '6',
        	'level' => '3',
        	'debit' => '0',
        	'credit' => '1',
        	'created_at' => '2018-07-19 15:03:59',
        	'updated_at' => '2018-07-19 15:03:59',
        ]);
    }

}


