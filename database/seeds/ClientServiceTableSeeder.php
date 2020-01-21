<?php

use Illuminate\Database\Seeder;

class ClientServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_service')->insert([
            'id' => 1,
            'client_id' => 1,
            'service_id' => 1,
        ]);

        DB::table('client_service')->insert([
            'id' => 2,
            'client_id' => 1,
            'service_id' => 2,
        ]);
    }
}
