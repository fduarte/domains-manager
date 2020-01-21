<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'hosting',
            'price' => '120'
        ]);

        DB::table('services')->insert([
            'name' => 'domain',
            'price' => '20'
        ]);
    }
}
