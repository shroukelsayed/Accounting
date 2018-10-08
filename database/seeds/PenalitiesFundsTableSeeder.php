<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class PenalitiesFundsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('penalities_funds')->insert([
            'id' => '1',
            'code' => '210601',
            'title' => 'صندوق جزاءات العاملين ',
            'parent' => '6',
            'level' => '4',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-22 13:22:15',
            'updated_at' => '2018-04-22 13:22:15',
        ]);

    }

}

