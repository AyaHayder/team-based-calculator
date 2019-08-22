<?php

use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stations')->insert([
            'name'=>'Addition',
            'value'=>20
        ]);

        DB::table('stations')->insert([
            'name'=>'Subtraction',
            'value'=>40
        ]);

        DB::table('stations')->insert([
            'name'=>'Multiplication',
            'value'=>60
        ]);

        DB::table('stations')->insert([
            'name'=>'Division',
            'value'=>80
        ]);

        DB::table('stations')->insert([
            'name'=>'To archive',
            'value'=>100
        ]);
    }
}
