<?php

namespace Tests\Feature;

use App\User;
use App\Label;
use Tests\TestCase;

class LabelTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->label = factory(Label::class)->create();
        $this->arrayLabel = factory(Label::class)->make()->only('name');
    }

    public function testIndex(): void
    {
        $this->get(route('label.index'))
            ->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('label.create'))
            ->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)
            ->post(route('label.store'), $this->arrayLabel)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('labels', $this->arrayLabel);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->user)
            ->get(route('label.edit', $this->label))
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user)
            ->put(route('label.update', $this->label), $this->arrayLabel)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('labels', $this->arrayLabel);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->user)
            ->delete(route('label.destroy', $this->label))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDeleted('labels', $this->arrayLabel);
    }
}
