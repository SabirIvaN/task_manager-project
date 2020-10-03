<?php

namespace Tests\Unit;

use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StatusTest extends TestCase
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
        $this->get(route('status.index'))
            ->assertOk();
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('status.create'))
            ->assertOk();
    }

    /**
     * A basic unit test store.
     *
     * @return void
     */
    public function testStore()
    {
        $status = factory(Status::class)->create();
        $data = ['name' => $status->name];
        $this->post(route('status.store'), $data)
            ->assertSee('status');
        $this->assertDatabaseHas('statuses', $data);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $status = factory(Status::class)->create();
        $this->get(route('status.edit', $status))
            ->assertOk();
    }

    /**
     * A basic unit test udpate.
     *
     * @return void
     */
    public function testUpdate()
    {
        $status = factory(Status::class)->create();
        $data = ['name' => $status->name];
        $this->patch(route('status.update', $status), $data)
            ->assertSee('status');
        $this->assertDatabaseHas('statuses', $data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $status = factory(Status::class)->create();
        $data = ['name' => $status->id];
        $this->delete(route('status.destroy', $status))
            ->assertSee('status');
        $this->assertDeleted('statuses', $data);
    }
}
