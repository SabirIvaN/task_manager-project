<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    public function testindex() : void
    {
        $this->get('/')->assertOk();
    }
}
