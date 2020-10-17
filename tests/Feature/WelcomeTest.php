<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    public function testIndex(): void
    {
        $this->get('/')->assertOk();
    }
}
