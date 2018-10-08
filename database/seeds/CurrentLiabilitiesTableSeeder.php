<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CurrentLiabilitiesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('current_liabilities')->insert([
            'id' => '1',
            'code' => '2101',
            'title' => 'الموردين ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-15 13:12:40',
            'updated_at' => '2018-04-15 13:12:40',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '2',
            'code' => '2102',
            'title' => 'مصروفات مستحقة ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 07:45:10',
            'updated_at' => '2018-04-16 07:45:10',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '3',
            'code' => '2103',
            'title' => 'شيكات تحت الصرف ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 10:03:13',
            'updated_at' => '2018-04-16 10:03:13',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '4',
            'code' => '2104',
            'title' => 'مصلحة الضرائب ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 10:03:31',
            'updated_at' => '2018-04-16 10:03:31',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '5',
            'code' => '2105',
            'title' => 'تأمينات الاجتماعية ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 10:03:47',
            'updated_at' => '2018-04-16 10:03:47',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '6',
            'code' => '2106',
            'title' => 'صندوق جزاءات ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 10:04:14',
            'updated_at' => '2018-04-16 10:04:14',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '7',
            'code' => '2107',
            'title' => 'صندوق الزمالة ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 10:04:27',
            'updated_at' => '2018-04-16 10:04:27',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '8',
            'code' => '2108',
            'title' => 'مبالغ تحت التسوية ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 10:04:43',
            'updated_at' => '2018-04-16 10:04:43',
        ]);

        DB::table('current_liabilities')->insert([
            'id' => '9',
            'code' => '2109',
            'title' => 'دائنون ',
            'level' => '3',
            'parent' => '3',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-16 10:04:57',
            'updated_at' => '2018-04-16 10:04:57',
        ]);

    }

}

