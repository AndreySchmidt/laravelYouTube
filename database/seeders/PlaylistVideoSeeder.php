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

    // верну дурацкий ватиант в с решением лоб
    public function run(): void
    {
        // $playlists = Playlist::all();

        // $pivotList = $playlists->flatMap(
        //     fn (Playlist $playlist) => $this->playlistVideos($playlist, $this->randomVideosFrom($playlist->channel))
        // );

        // DB::table('playlist_video')->insert($pivotList->all());

        // запишем короткой версией
        Playlist::all()->each(
            function (Playlist $playlist) {
                $playlist->videos()->saveMany($this->randomVideosFrom($playlist->channel));
            }
        );
    }

    private function playlistVideos(Playlist $playlist, Collection $videos):Collection
    {
        return $videos->map(fn (Video $video) => [
            'playlist_id' => $playlist->id,
            'video_id' => $video->id,
            'channel_id' => $playlist->channel->id,
        ]);
    }

    private function randomVideosFrom(Channel $channel):Collection
    {
        // если на канале нет видео, вернем пустую коллекцию (пихать в mt_rand(1, count($channel->videos)) ноль как понятно нельзя)
        // if($channel->videos->isEmpty())
        // {
        //     return collect();
        // }

        // return $channel->videos->random(mt_rand(1, $channel->videos->count()));

        // запищем короткой версией
        return $channel->videos->whenEmpty(
            fn () => collect(),// если пустой канал
            fn (Collection $videos) => $videos->random(mt_rand(1, $videos->count()))// если не пустой канал
        );
    }
}
