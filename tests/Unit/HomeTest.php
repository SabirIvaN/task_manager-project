<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->actingAs($this->user)
            ->get('/home');
        $response->assertOk();
    }
}
