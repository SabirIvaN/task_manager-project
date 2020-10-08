<?php

namespace Tests\Unit;

use App\Status;
use Tests\TestCase;
use Illuminate\Support\Arr;
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
        $status = factory(Status::class)->make()->toArray();
        $data = Arr::only($status, ['name']);
        $this->post(route('status.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
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
        $factoryData = factory(Status::class)->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $this->put(route('status.update', $status), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
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
        $factoryData = factory(Status::class)->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $this->delete(route('status.destroy', $status))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDeleted('statuses', $data);
    }
}
