<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
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
            DB::table('statuses')->insert(['name' => $statuses[$i], 'created_at' => now()]);
        }
    }
}
