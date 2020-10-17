<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labels')->insert([
            'name' => 'Hexlet',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('labels')->insert([
            'name' => 'PHP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('labels')->insert([
            'name' => 'Project',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('labels')->insert([
            'name' => 'Level 4',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('labels')->insert([
            'name' => 'Task manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
