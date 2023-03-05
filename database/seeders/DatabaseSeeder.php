<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Fluent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userData = new Fluent([
            'name' => 'Beny Allan',
            'email' => 'benyallan@gamil.com',
            'password' => 'teste123',
        ]);
    }
}
