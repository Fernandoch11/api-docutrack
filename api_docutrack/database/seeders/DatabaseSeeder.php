<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersAccesSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(UsersAccesSeeder::class);
    }
}
