<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class LevelThreeGeneralExpensesTableSeeder extends Seeder {

    public function run()
    {
  
        DB::table('level_three_general_expenses')->insert([
            'id' => '1',
            'code' => '3101',
            'title' => 'مصروفات عمومية -مصر الجديدة ',
            'parent' => '4',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-05-03 09:15:13',
            'updated_at' => '2018-05-03 09:15:13',
        ]);

        DB::table('level_three_general_expenses')->insert([
            'id' => '2',
            'code' => '3102',
            'title' => 'مصروفات عمومية -المهندسين',
            'parent' => '4',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-06-20 10:35:56',
            'updated_at' => '2018-06-20 10:35:56',
        ]);
    }

}
