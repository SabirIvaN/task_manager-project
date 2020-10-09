<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function setUp(): void
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
        $this->actingAs($this->user)
            ->get('/home')
            ->assertOk();
    }
}
