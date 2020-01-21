<?php

namespace Tests\Unit;

use App\Service;
use Tests\TestCase;

/**
 * Class ServiceTest
 * @package Tests\Unit
 */
class ServiceTest extends TestCase
{
    public function testService()
    {

        $this->assertDatabaseHas('services', [
            'id' => 1
        ]);

        $service = Service::find(1);
        $this->assertNotEmpty($service->name);

        // Assert service has some clients
        $this->assertNotEmpty($service->clients);

        foreach($service->clients as $client) {
            $this->assertNotEmpty($client->name);
        }
    }
}
