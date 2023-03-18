<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 * 
 * ./vendor/bin/sail artisan make:factory ChannelFactory
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(mt_rand(1, 2), true)),
            // вытащить из базы одного из имеющихся там пользователей
            'user_id' => User::inRandomOrder()->first()->id,
            // а можно создать на лету пользователя и присвоить его id в поле user_id
            // 'user_id' => User::factory(),
        ];
    }
}
