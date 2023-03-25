<?php

namespace Database\Factories;

use App\Enums\Period;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    public function definition(): array
    {
        // $createdAt = $this->createdAt();

        // вместо $this->faker буду писать fake()
        return [
            'title' => ucfirst(fake()->words(mt_rand(1, 2), true)),
            'description' => fake()->sentences(mt_rand(1, 3), true),
            'channel_id' => Channel::inRandomOrder()->first(),
            // сгенерирую даты фейкером (закоментил ибо буду менять это через стейт, вызов в сидере)
            // 'created_at' => $createdAt,
            // 'updated_at' => $createdAt,
        ];
    }

    // public function createdAt()
    // {
    //     $period = $this->faker->randomElement(['year', 'month', 'week', 'day', 'hour']);
    //     return $this->faker->dateTimeBetween("-1 $period");
    // }

    // в ларавел есть стандартные средства, например состояние фабрики (этот метод представляет состояние ласт)
    public function last(Period $period)
    {
        
        return $this->state(function() use ($period)
        {
            // $period->value получим в виде строки
            $createdAt = fake()->dateTimeBetween("-1 $period->value");

            // переопределим в стейте даты создания, обновления
            return [
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // public function definition(): array
    // {
    //     $strDate = $this->faker->dateTimeThisYear();
    //     // $strDate = $this->faker->dateTimeThisMonth();
    //     // $strDate = $this->faker->dayOfWeek();
    //     // между 2 месяца назад от сейчас до 1 недели вперед
    //     // $strDate = $this->faker->dateTimeBetween('-2 months', '+1 week');
    //     // между 1 неделя назад от 1 недели назад до 3 дней вперед
    //     // $strDate = $this->faker->dateTimeInInterval('-1 week', '+3 days');

    //     return [
    //         'title' => ucfirst($this->faker->words(mt_rand(1, 2), true)),
    //         // true если одной строкой 4 предложения false - в виде массива
    //         'description' => $this->faker->sentences(4, true),
    //         'channel_id' => Channel::inRandomOrder()->first()->id,
    //         // сгенерирую даты фейкером
    //         'created_at' => $strDate,
    //         'updated_at' => $strDate,
    //     ];
    // }
}
