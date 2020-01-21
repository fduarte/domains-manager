<?php

namespace Tests\Unit;

use App\Domain;
use Tests\TestCase;

/**
 * Class DomainTest
 * @package Tests\Unit
 */
class DomainTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDomain()
    {
        $this->assertDatabaseHas('domains', [
            'id' => 1
        ]);

        // Assert domain has a client
        $domain = Domain::find(1);
        $this->assertNotEmpty($domain->domain_name);
        $this->assertNotEmpty($domain->client);
        $this->assertNotEmpty($domain->client->name);

    }
}
