<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            PlaylistSeeder::class,
            VideoSeeder::class,
            CategorySeeder::class,
            CategoryVideoSeeder::class,
            PlaylistVideoSeeder::class,
            CommentSeeder::class,
        ]);


        // другой вариант работы с сидером
        // User::factory(2)->has(// создать два пользователя
        //     Channel::factory()->has(// каждому пользователю канал
        //         Video::factory(3)->has(// каждому каналу 3 видео
        //             Category::factory(3)// каждому видео 3 категории
        //         )
        //     )
        // )->create();

    }
}
