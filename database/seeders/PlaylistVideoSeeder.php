<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Channel;
use App\Models\Playlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ./vendor/bin/sail artisan db:seed --class PlaylistVideoSeeder
     */
    public function run(): void
    {
        //слишком много запросов в БД, уменьшим их количество 
        Playlist::with('channel.videos')->get()->each(
            fn (Playlist $playlist) => $playlist->videos()->saveMany($this->randomVideosFrom($playlist->channel))
        );
    }

    private function randomVideosFrom(Channel $channel):Collection
    {
        return $channel->videos->whenEmpty(
            fn () => collect(),// если пустой канал
            fn (Collection $videos) => $videos->random(mt_rand(1, $videos->count()))// если не пустой канал
        );
    }
}
