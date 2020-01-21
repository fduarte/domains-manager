<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('clients')->insert([
            'name' => $faker->firstName . ' ' . $faker->lastName,
            'company_name' => $faker->company,
            'email' => $faker->email,
        ]);

        DB::table('clients')->insert([
            'name' => $faker->firstName . ' ' . $faker->lastName,
            'company_name' => $faker->company,
            'email' => $faker->email,
        ]);
    }
}
