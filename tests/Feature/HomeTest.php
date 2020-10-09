<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class HomeTest extends TestCase
{

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get('/home')
            ->assertOk();
    }
}
