<?php

namespace Tests\Unit;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertOk();
    }
}
