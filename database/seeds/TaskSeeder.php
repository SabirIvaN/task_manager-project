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
        $statuses = ['New', 'In work', 'On testing', 'Completed'];
        for ($i=0; $i < count($statuses); $i++) {
            DB::table('statuses')->insert(['name' => $statuses[$i]]);
        }
    }
}
