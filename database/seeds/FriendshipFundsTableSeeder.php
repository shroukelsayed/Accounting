<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class FriendshipFundsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('friendship_funds')->insert([
            'id' => '1',
            'code' => '210701',
            'title' => 'صندوق الزمالة العاملين ',
            'parent' => '7',
            'level' => '4',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-22 13:22:39',
            'updated_at' => '2018-04-22 13:22:39',
        ]);

    }

}
