<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Chama outros seeders
        $this->call([
            UserSeeder::class,
            DemandSeeder::class,
        ]);
    }
}