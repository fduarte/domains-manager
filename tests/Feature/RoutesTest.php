<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoutes()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/domains');
        $response->assertStatus(200);

        $response = $this->get('/domain/add');
        $response->assertStatus(200);

        $response = $this->get('/domain/create');
        $response->assertStatus(200);
    }
}
