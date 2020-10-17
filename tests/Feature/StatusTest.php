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
        $this->get(route('status.index'))
            ->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('status.create'))
            ->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)
            ->post(route('status.store'), $this->arrayStatus)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('statuses', $this->arrayStatus);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->user)
            ->get(route('status.edit', $this->status))
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user)
            ->put(route('status.update', $this->status), $this->arrayStatus)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('statuses', $this->arrayStatus);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->user)
            ->delete(route('status.destroy', $this->status))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDeleted('statuses', $this->arrayStatus);
    }
}
