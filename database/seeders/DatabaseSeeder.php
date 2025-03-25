<?php

namespace Database\Seeders;

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
        // Gọi seeder của AdminUserSeeder
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}

