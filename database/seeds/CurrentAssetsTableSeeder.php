<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CurrentAssetsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('current_assets')->insert([
            'id' => '1',
            'code' => '1201',
            'title' => 'الخزينة',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-10 08:21:26',
            'updated_at' => '2018-04-10 08:21:26',
        ]);

        DB::table('current_assets')->insert([
            'id' => '2',
            'code' => '1202',
            'title' => 'البنك ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-10 08:50:33',
            'updated_at' => '2018-04-10 08:50:33',
        ]);


        DB::table('current_assets')->insert([
            'id' => '3',
            'code' => '1203',
            'title' => 'مصروفات مقدمة ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-10 09:03:05',
            'updated_at' => '2018-04-10 09:03:05',
        ]);


        DB::table('current_assets')->insert([
            'id' => '4',
            'code' => '1204',
            'title' => 'تأمينات لدي الغير ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-15 12:55:21',
            'updated_at' => '2018-04-15 12:55:21',
        ]);


        DB::table('current_assets')->insert([
            'id' => '5',
            'code' => '1205',
            'title' => 'عهد و سلف ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-15 14:58:17',
            'updated_at' => '2018-04-15 14:58:17',
        ]);


        DB::table('current_assets')->insert([
            'id' => '6',
            'code' => '1206',
            'title' => 'ايرادات مستحقة ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:27:46',
            'updated_at' => '2018-04-16 08:27:46',
        ]);


        DB::table('current_assets')->insert([
            'id' => '7',
            'code' => '1207',
            'title' => 'مدينون متنوعون',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:28:15',
            'updated_at' => '2018-04-16 08:28:15',
        ]);


        DB::table('current_assets')->insert([
            'id' => '8',
            'code' => '1208',
            'title' => 'أرصدة مدينة أخري ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:28:30',
            'updated_at' => '2018-04-16 08:28:30',
        ]);


        DB::table('current_assets')->insert([
            'id' => '9',
            'code' => '1209',
            'title' => 'المخزن ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:28:52',
            'updated_at' => '2018-04-16 08:28:52',
        ]);


        DB::table('current_assets')->insert([
            'id' => '10',
            'code' => '1210',
            'title' => 'شيكات تحت التحصيل ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:29:21',
            'updated_at' => '2018-04-16 08:29:21',
        ]);


        DB::table('current_assets')->insert([
            'id' => '11',
            'code' => '1211',
            'title' => 'شركة فوري ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:29:37',
            'updated_at' => '2018-04-16 08:29:37',
        ]);


        DB::table('current_assets')->insert([
            'id' => '12',
            'code' => '1212',
            'title' => 'رسائل قصيرة ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:30:00',
            'updated_at' => '2018-04-16 08:30:00',
        ]);


        DB::table('current_assets')->insert([
            'id' => '13',
            'code' => '1213',
            'title' => 'ماكينة CIB ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:30:16',
            'updated_at' => '2018-04-16 08:30:16',
        ]);


        DB::table('current_assets')->insert([
            'id' => '14',
            'code' => '1214',
            'title' => 'الوادئع ',
            'parent' => '2',
            'level' => '3',
            'debit' => '0',
            'credit' => '1',
            'created_at' => '2018-04-16 08:30:16',
            'updated_at' => '2018-04-16 08:30:16',
        ]);

    }

}

