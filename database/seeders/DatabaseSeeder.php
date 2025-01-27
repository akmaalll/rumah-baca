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
        $this->call([
            UserSeeder::class,
            KategoriBukuSeeder::class,
            BukuSeeder::class,
            ClusterBukuSeeder::class,
            PreferensiUserSeeder::class,
            RekomendasiBukuSeeder::class,
            ClusteringSeeder::class,
        ]);
    }
}
