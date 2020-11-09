<?php

use Illuminate\Support\Facades\DB;
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
        DB::table('statuses')->insert([
            'name' => 'New',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('statuses')->insert([
            'name' => 'In work',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('statuses')->insert([
            'name' => 'Testings',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('statuses')->insert([
            'name' => 'Completed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
