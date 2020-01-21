<?php

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('domains')->insert([
            'id' => 1,
            'domain_name' => 'google.com',
        ]);

        DB::table('domains')->insert([
            'id' => 2,
            'domain_name' => 'yahoo.com',
        ]);
    }
}
