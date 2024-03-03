<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Afandi',
            'username' => 'afandi',
            'password' => bcrypt('1234'),
            'user_role' => 'admin'
        ]);
        User::create([
            'name' => 'Muhammad',
            'username' => 'muhammad',
            'password' => bcrypt('1234'),
            'user_role' => 'owner'
        ]);
        Service::create(['service_name' => 'Taman']);
        Service::create(['service_name' => 'Kembar Mayang']);
        Service::create(['service_name' => 'Stogor']);
        Service::create(['service_name' => 'Pasang Kembang']);
        Service::create(['service_name' => 'Plafon']);
    }
}
