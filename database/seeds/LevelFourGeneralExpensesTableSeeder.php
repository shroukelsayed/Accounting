<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class LevelFourGeneralExpensesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('level_four_general_expenses')->insert([
            'id' => '1',
            'code' => '310101',
            'title' => 'مصروفات عمومية -مصر الجديدة',
            'parent' => '1',
            'level' => '4',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-05-03 09:15:44',
            'updated_at' => '2018-05-03 09:15:44',
        ]);

    }

}

