<?php

namespace Tests\Feature;

use App\User;
use App\Label;
use Tests\TestCase;

class LabelTest extends TestCase
{
    private User $user;
    private Label $label;
    private array $labelName;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->label = factory(Label::class)->create();
        $this->labelName = factory(Label::class)->make()->only('name');
    }

    public function testIndex(): void
    {
        $this->get(route('labels.index'))
            ->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('labels.create'))
            ->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)
            ->post(route('labels.store'), $this->labelName)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('labels', $this->labelName);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->user)
            ->get(route('labels.edit', $this->label))
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user)
            ->put(route('labels.update', $this->label), $this->labelName)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('labels', $this->labelName);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->user)
            ->delete(route('labels.destroy', $this->label))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseMissing('labels', $this->labelName);
    }
}
