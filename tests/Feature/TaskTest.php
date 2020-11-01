<?php

namespace Tests\Feature;

use App\User;
use App\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    private Task $task;
    private User $user;
    private array $factoryData;
    private array $testData;

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
        $this->get(route('tasks.index'))
            ->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('tasks.create'))
            ->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)
            ->post(route('tasks.store'), $this->factoryData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('tasks', $this->testData);
    }

    public function testShow(): void
    {
        $this->get(route('tasks.show', $this->task))
            ->assertOk();
    }

    public function testEdit(): void
    {
        $this->actingAs($this->task->createdBy)
            ->get(route('tasks.edit', $this->task))
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->task->createdBy)
            ->patch(route('tasks.update', $this->task), $this->factoryData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('tasks', $this->testData);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->task->createdBy)
            ->delete(route('tasks.destroy', $this->task))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseMissing('tasks', $this->factoryData);
    }
}
