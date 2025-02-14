<?php

namespace Database\Seeders;

use App\Models\Clustering;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClusteringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Buat beberapa record proses clustering
        Clustering::create([
            ['user_id' => 1, 'jumlah_cluster' => 3],
        ]);
    }
}
