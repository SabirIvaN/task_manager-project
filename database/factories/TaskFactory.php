<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Task;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'description' => $faker->text(300),
        'status_id' => function() {
            return factory(App\Status::class)->create()->id;
        },
        'created_by_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'assigned_to_id' => function() {
            return factory(App\User::class)->create()->id;
        },
    ];
});
