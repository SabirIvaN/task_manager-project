<?php

namespace Tests\Feature;

use App\User;
use App\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->task = factory(Task::class)->create();
        $this->user = $this->task->createdBy;
        $this->factoryData = factory(Task::class)->make()->only('name', 'description', 'status_id', 'assigned_to_id');
        $this->testData = array_merge($this->factoryData, ['created_by_id' => $this->user->id]);
    }

    public function testIndex(): void
    {
        $this->get(route('task.index'))
            ->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('task.create'))
            ->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)
            ->post(route('task.store'), $this->factoryData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('tasks', $this->testData);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->task->createdBy)
            ->get(route('task.edit', $this->task))
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->task->createdBy)
            ->patch(route('task.update', $this->task), $this->factoryData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('tasks', $this->testData);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->task->createdBy)
            ->delete(route('task.destroy', $this->task))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDeleted('tasks', $this->factoryData);
    }
}
