<?php

namespace Tests\Feature;

use App\User;
use App\Label;
use Tests\TestCase;

class LabelTest extends TestCase
{
    public function testIndex()
    {
        $this->get(route('label.index'))
            ->assertOk();
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get(route('label.create'))
            ->assertOk();
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $label = factory(Label::class)->make();
        $data = ['name' => $label->name];
        $this->actingAs($user)
            ->post(route('label.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();
        $label = factory(Label::class)->create();
        $this->actingAs($user)
            ->get(route('label.edit', $label))
            ->assertOk();
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $label = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make();
        $data = ['name' => $label->name];
        $this->actingAs($user)
            ->put(route('label.update', $label), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $label = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make();
        $data = ['name' => $factoryData->name];
        $this->actingAs($user)
            ->delete(route('label.destroy', $label))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDeleted('labels', $data);
    }
}
