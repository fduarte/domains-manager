<?php

namespace Tests\Unit;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Client as Client;

class ClientTest extends TestCase
{

    // @todo - this will likely be necessary when testing seeder is in place
    // use RefreshDatabase;

    public function testClient()
    {
        // @todo - Eventually I will have a seeder specific for testing
        // $this->seed(\ClientsServicesTableSeeder::class);

        // Assert there's some data in the clients table
        $this->assertDatabaseHas('clients', [
                'id' => 1
            ]);

        // Another way of asserting there's some data in the clients table
        $client = Client::find(1);
        $this->assertNotEmpty($client->name);

        // Assert there are services associated to client
        $this->assertNotEmpty($client->services);
        $basicServices = ['hosting', 'domain'];

        foreach($client->services as $service) {
            $this->assertContains($service->name,$basicServices);
        }

    }
}
