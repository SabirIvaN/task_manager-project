<?php

namespace Tests\Feature;

use App\User;
use App\Status;
use Tests\TestCase;

class StatusTest extends TestCase
{
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
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get(route('status.create'))
            ->assertOk();
    }

    /**
     * A basic unit test store.
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create();
        $status = factory(Status::class)->make();
        $data = ['name' => $status->name];
        $this->actingAs($user)
            ->post(route('status.store'), $data)
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
        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();
        $this->actingAs($user)
            ->get(route('status.edit', $status))
            ->assertOk();
    }

    /**
     * A basic unit test udpate.
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();
        $factoryData = factory(Status::class)->make();
        $data = ['name' => $factoryData->name];
        $this->actingAs($user)
            ->put(route('status.update', $status), $data)
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
        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();
        $factoryData = factory(Status::class)->make();
        $data = ['name' => $factoryData->name];
        $this->actingAs($user)
            ->delete(route('status.destroy', $status))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDeleted('statuses', $data);
    }
}
