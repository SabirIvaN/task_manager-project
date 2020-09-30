<?php

namespace Tests\Unit;

use App\User;
use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StatusTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->status = factory(Status::class)->create();
        $this->data = ['name' => $this->status->name];
    }

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('status.index'));
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
            ->get(route('status.create'));
        $response->assertOk();
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testStore()
    {
        $this->actingAs($this->user)
            ->post(route('status.store'), $this->data)
            ->assertRedirect();
        $this->assertDatabaseHas('statuses', $this->data);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $response = $this->actingAs($this->user)
            ->get(route('status.edit', $this->status));
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
            ->patch(route('status.update', $this->status), $this->data)
            ->assertRedirect();
        $this->assertDatabaseHas('statuses', $this->data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->actingAs($this->user)
            ->delete(route('status.destroy', $this->status))
            ->assertRedirect();
        $this->assertDeleted('statuses', $this->data);
    }
}
