<?php

use Illuminate\Database\Seeder;


use Laracasts\TestDummy\Factory as TestDummy;

class SocialInsurancesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('social_insurances')->insert([
            'id' => '1',
            'code' => '210501',
            'title' => 'تأمينات الاجتماعية حصة الموظفين',
            'parent' => '5',
            'level' => '4',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-22 13:37:38',
            'updated_at' => '2018-04-22 13:37:38',
        ]);

        DB::table('social_insurances')->insert([
            'id' => '2',
            'code' => '210502',
            'title' => 'تأمينات الاجتماعية حصة المؤسسة ',
            'parent' => '5',
            'level' => '4',
            'debit' => '1',
            'credit' => '0',
            'created_at' => '2018-04-22 13:37:57',
            'updated_at' => '2018-04-22 13:37:57',
        ]);
    }

}
