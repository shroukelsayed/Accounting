<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class SuppliersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('suppliers')->insert([
            'id' => '1',
            'code' => '210101',
            'title' => 'دائنون',
            'parent' => '1',
            'level' => '4',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-05-03 09:11:56',
            'updated_at' => '2018-05-03 09:11:56',
        ]);

    }

}
