<?php

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
        $taskName = ['Project', 'Dishes', 'Homework', 'Exercise'];
        $taskDescription = ['Work on projects', 'Wash the dishes', 'Do your homework', 'Do morning exercise'];
        for ($i = 0; $i < count($taskName); $i++) {
            DB::table('tasks')->insert([
                'name' => $taskName[$i],
                'description' => $taskDescription[$i],
                'status_id' => rand(0, 5),
                'created_by_id' => rand(0, 5),
                'assigned_to_id' => rand(0, 5),
                'created_at' => now(),
            ]);
        }

    }
}
