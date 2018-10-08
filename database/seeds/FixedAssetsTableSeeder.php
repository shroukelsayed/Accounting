<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class FixedAssetsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('fixed_assets')->insert([
            'id' => '1',
            'code' => '1101',
            'title' => 'مكاتب واثاث',
            'parent' => '1',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-04 10:05:35',
            'updated_at' => '2018-04-04 10:05:35',
        ]);

        DB::table('fixed_assets')->insert([
        	'id' => '2',
        	'code' => '1102',
        	'title' => 'تركيبات و ديكورات',
        	'parent' => '1',
        	'level' => '3',
        	'debit' => '0',
        	'credit' => '1',
        	'created_at' => '2018-04-04 10:08:14',
        	'updated_at' => '2018-04-04 10:08:14',
        ]);
		DB::table('fixed_assets')->insert([
			'id' => '3',
			'code' => '1103',
			'title' => 'تكييفات ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-10 06:10:11',
			'updated_at' => '2018-04-10 06:10:11',
		]);
		DB::table('fixed_assets')->insert([
			'id' => '4',
			'code' => '1104',
			'title' => 'ماكينات تصوير ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-15 07:50:07',
			'updated_at' => '2018-04-15 07:50:07',
		]);
		DB::table('fixed_assets')->insert([
			'id' => '5',
			'code' => '1105',
			'title' => 'برنتروفاكس ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-15 07:51:46',
			'updated_at' => '2018-04-15 07:51:46',
		]);
		DB::table('fixed_assets')->insert([
			'id' => '6',
			'code' => '1106',
			'title' => 'سنترال و تليفونات ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-15 09:19:13',
			'updated_at' => '2018-04-15 09:19:13',
		]);
		DB::table('fixed_assets')->insert([
			'id' => '7',
			'code' => '1107',
			'title' => 'أجهزة كهربائية ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-15 10:55:51',
			'updated_at' => '2018-04-15 10:55:51',
		]);
		DB::table('fixed_assets')->insert([
			'id' => '8',
			'code' => '1108',
			'title' => 'برامج و نظم ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-15 12:51:22',
			'updated_at' => '2018-04-15 12:51:22',
		]);
		DB::table('fixed_assets')->insert([
			'id' => '9',
			'code' => '1109',
			'title' => 'ويب سيت ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-19 08:48:10',
			'updated_at' => '2018-04-19 08:48:10',
		]);
		DB::table('fixed_assets')->insert([
			'id' => '10',
			'code' => '1110',
			'title' => 'أجهزة كمبيوتر ',
			'parent' => '1',
			'level' => '3',
			'debit' => '0',
			'credit' => '1',
			'created_at' => '2018-04-19 08:49:39',
			'updated_at' => '2018-04-19 08:49:39',
		]);

    }

}

