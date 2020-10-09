<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class HomeTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/home')
            ->assertOk();
    }
}
