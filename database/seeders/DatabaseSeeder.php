<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * ./vendor/bin/sail artisan migrate:refresh
     * ./vendor/bin/sail artisan db:seed
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // вызвать все сидеры
        $this->call([
            UserSeeder::class,
            ChannelSeeder::class,
            VideoSeeder::class,
            CategorySeeder::class,
            CategoryVideoSeeder::class,
        ]);
    }
}
