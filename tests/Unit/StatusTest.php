<?php

namespace Tests\Unit;

use App\User;
use App\Status;
use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class StatusTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createMock(User::class);
        $this->status = factory(Status::class)->create();
        $this->data = Arr::only(factory(Status::class)->make()->toArray(), ['name']);
    }

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('status.index'));
        $this->assertEquals(200, $response->status());
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
        $this->assertEquals(200, $response->status());
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testStore()
    {
        $this->actingAs($this->user)
            ->post(route('status.store'), $this->data);
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
        $this->assertEquals(200, $response->status());
    }

    /**
     * A basic unit test update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->actingAs($this->user)
            ->patch(route('status.update', $this->status), $this->data);
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
            ->delete(route('status.destroy', $this->status));
        $this->assertDeleted('statuses', ['id' => $this->status]);
    }
}
