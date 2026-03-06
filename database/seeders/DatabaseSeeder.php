<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        Client::truncate();
        Vehicle::truncate();

        $this->call([
            ClientSeeder::class,
            UserSeeder::class,
            VehicleSeeder::class, 
        ]);
    }
}
