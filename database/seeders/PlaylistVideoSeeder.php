<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Playlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ./vendor/bin/sail artisan db:seed --class PlaylistVideoSeeder
     */

    // верну дурацкий ватиант в с решением лоб
    public function run(): void
    {
        $playlistIds = Playlist::pluck('id');
        $videoIds = Video::pluck('id');

        $pivotList = $playlistIds->flatMap(
            fn (int $id) => $this->playlistVideos($id, $this->randomVideoIds($videoIds))
        );

        DB::table('playlist_video')->insert($pivotList->all());
    }

    private function playlistVideos(int $playlistId, Collection $videoIds):Collection
    {
        return $videoIds->map(fn (int $id) => [
            'playlist_id' => $playlistId,
            'video_id' => $id,
        ]);
    }

    private function randomVideoIds(Collection $videoIds):Collection
    {
        return $videoIds->random(mt_rand(1, count($videoIds)));
    }
}
