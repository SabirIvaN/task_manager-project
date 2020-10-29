<?php

namespace Tests\Feature;

use App\User;
use App\Status;
use Tests\TestCase;

class StatusTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->status = factory(Status::class)->create();
        $this->arrayStatus = factory(Status::class)->make()->only('name');
    }

    public function testIndex(): void
    {
        $this->get(route('statuses.index'))
            ->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('statuses.create'))
            ->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)
            ->post(route('statuses.store'), $this->arrayStatus)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('statuses', $this->arrayStatus);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->user)
            ->get(route('statuses.edit', $this->status))
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user)
            ->put(route('statuses.update', $this->status), $this->arrayStatus)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('statuses', $this->arrayStatus);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->user)
            ->delete(route('statuses.destroy', $this->status))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDeleted('statuses', $this->arrayStatus);
    }
}
