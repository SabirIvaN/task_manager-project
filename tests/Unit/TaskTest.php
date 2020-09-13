<?php

namespace Tests\Unit;

use App\User;
use App\Task;
use App\Label;
use App\Status;
use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->task = factory(Task::class)->create();
        $this->status = factory(Status::class)->create();
        $this->data = Arr::only(factory(Task::class)->make()->toArray(), [
            'name' => 'On testing',
            'description' => 'Testing the functionality using',
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id,
            'assigned_to_id' => $this->user->id,
        ]);
    }

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('task.index'));
        $response->assertOk();
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task.create'));
        $response->assertOk();
    }

    /**
     * A basic unit test store.
     *
     * @return void
     */
    public function testStore()
    {
        $this->actingAs($this->user)
            ->post(route('task.store'), $this->data);
        $this->assertDatabaseHas('tasks', $this->data);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task.edit', $this->task));
        $response->assertOk();
    }

    /**
     * A basic unit test update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->actingAs($this->user)
            ->patch(route('task.update', $this->task), $this->data);
        $this->assertDatabaseHas('tasks', $this->data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->actingAs($this->user)
            ->delete(route('task.destroy', $this->task));
        $this->assertDeleted('tasks', ['id' => $this->task]);
    }
}
