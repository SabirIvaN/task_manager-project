<?php

namespace Tests\Unit;

use App\User;
use App\Label;
use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get(route('label.index'))
            ->assertOk();
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('label.create'))
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
        $label = factory(Label::class)->make();
        $data = ['name' => $label->name];
        var_dump($user->hasVerifiedEmail());
        $this->actingAs($user)
            ->post(route('label.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $label = factory(Label::class)->create();
        $this->get(route('label.edit', $label))
            ->assertOk();
    }

    /**
     * A basic unit test update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $label = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $this->put(route('label.update', $label), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $label = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $this->delete(route('label.destroy', $label))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDeleted('labels', $data);
    }
}
