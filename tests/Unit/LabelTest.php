<?php

namespace Tests\Unit;

use App\User;
use App\Label;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LabelTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->label = factory(Label::class)->create();
        $this->data = ['name' => $this->label->name];
    }

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('label.index'));
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
            ->get(route('label.create'));
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
            ->post(route('label.store'), $this->data)
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $this->data);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $response = $this->actingAs($this->user)
            ->get(route('label.edit', $this->label));
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
            ->patch(route('label.update', $this->label), $this->data)
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $this->data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->actingAs($this->user)
            ->delete(route('label.destroy', $this->label))
            ->assertRedirect();
        $this->assertDeleted('labels', $this->data);
    }
}
