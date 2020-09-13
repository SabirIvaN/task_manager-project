<?php

use App\Task;
use App\Label;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = factory(Task::class, 5)->create();
        $labels = factory(Label::class, 5)->create();
        $task->each(function (Task $task) use ($labels) {
            $task->labels()->attach($labels->random(rand(0, 5))->pluck('id')->toArray());
        });
    }
}
