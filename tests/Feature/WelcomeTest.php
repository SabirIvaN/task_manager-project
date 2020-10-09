<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testindex()
    {
        $this->get('/')->assertOk();
    }
}
