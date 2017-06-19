<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventoryPageTest extends TestCase
{
    /**
     * Test the Inventory Page
     *
     * @return void
     */
    public function testInventoryPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
