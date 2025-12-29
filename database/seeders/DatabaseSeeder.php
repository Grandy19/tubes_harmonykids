<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(PengelolaSeeder::class);
        $this->call(DummyInstansiSeeder::class);
        $this->call(WaliSeeder::class);
        $this->call(DummyForumSeeder::class);
    }
}
