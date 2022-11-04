<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'wicaksu',
            'email' => 'wicaksu@wicaksu.com',
            'password' => bcrypt('Jack03061997'),
            'role' => 'admin',
            'phone' => '082244456708',
        ]);
    }
}
