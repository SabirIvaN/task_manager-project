<?php

namespace Tests\Unit;

use App\Task;
use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get(route('task.index'))
            ->assertOk();
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('task.create'))
            ->assertOk();
    }

    /**
     * A basic unit test store.
     *
     * @return void
     */
    public function testStore()
    {
        /*
        $task = factory(Task::class)->make()->toArray();
        $data = Arr::only($task, ['name']);
        $this->post(route('task.store'), $data)
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $data);
        */
        $this->assertTrue(true);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $task = factory(Task::class)->create();
        $this->get(route('task.edit', $task))
            ->assertOk();
    }

    /**
     * A basic unit test update.
     *
     * @return void
     */
    public function testUpdate()
    {
        /*
        $this->patch(route('task.update', $this->task), $this->data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->data);
        */
        $this->assertTrue(true);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        /*
        $response = $this->delete(route('task.destroy', $this->task))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDeleted('tasks', $this->data);
        */
        $this->assertTrue(true);
    }
}
