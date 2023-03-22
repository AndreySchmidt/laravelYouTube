<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $strDate = $this->faker->dateTimeThisYear();
        // $strDate = $this->faker->dateTimeThisMonth();
        // $strDate = $this->faker->dayOfWeek();
        // между 2 месяца назад от сейчас до 1 недели вперед
        // $strDate = $this->faker->dateTimeBetween('-2 months', '+1 week');
        // между 1 неделя назад от 1 недели назад до 3 дней вперед
        // $strDate = $this->faker->dateTimeInInterval('-1 week', '+3 days');

        return [
            'title' => ucfirst($this->faker->words(mt_rand(1, 2), true)),
            'channel_id' => Channel::inRandomOrder()->first()->id,
            // сгенерирую даты фейкером
            'created_at' => $strDate,
            'updated_at' => $strDate,
        ];
    }
}
