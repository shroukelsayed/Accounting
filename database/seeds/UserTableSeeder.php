<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
         DB::table('users')->insert([
            'id' => 1,
            'name' => 'shrouk',
            'email' => 'shrouk@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 1,
            'active' => true,
        ]);
    }

}