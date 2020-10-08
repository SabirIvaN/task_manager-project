<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HomeTest extends TestCase
{
    use WithoutMiddleware;

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
