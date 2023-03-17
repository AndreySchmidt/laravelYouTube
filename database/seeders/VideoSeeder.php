<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Video::factory()->count(10)->create();

        // $arrVideoList = [];

        // foreach( range(1, 3) AS $intI ){

        //     $arrVideoList[] = [
        //         'title' => 'arrVideoList'.$intI,
        //         'channel_id' => $intI,
        //     ];
        // }

        // if(!empty($arrVideoList))
        // {
        //     DB::table('videos')->insert($arrVideoList);
        // }

        // обратное отношение один ко многим

        // создаем 4 видео и указываем какому каналу они должны принадлежать
        // (создав его, пользователь к каналу возьмется из фабрики канала, на данный момент он выбирается рандомно из существующих)
        // Video::factory()->count(4)->for(Channel::factory())->create();

        // создаем 2 видео и указываем какому каналу они должны принадлежать
        // (создав его, пользователь к каналу создается)
        Video::factory()->count(2)->for(Channel::factory()->forUser())->create();
    }
}
