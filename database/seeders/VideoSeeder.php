<?php

namespace Database\Seeders;

use App\Enums\Period;
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
        // last() метод в фабрике для работы с состоянием
        // Video::factory(4)->last('year')->create();
        // Video::factory(5)->last('month')->create();
        // Video::factory(2)->last('week')->create();
        // Video::factory(3)->last('day')->create();
        // Video::factory(1)->last('hour')->create();

        // Video::factory(4)->last(Period::Year)->create();
        // Video::factory(5)->last(Period::Month)->create();
        // Video::factory(2)->last(Period::Week)->create();
        // Video::factory(3)->last(Period::Day)->create();
        // Video::factory(1)->last(Period::Hour)->create();

        // на перечислениях есть стандартный метод cases() для получения всех значений свойств
        // получу свойства и сделаю из них коллекцию
        collect(Period::cases())->each(fn (Period $period) => Video::factory(4)->last($period)->create());


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
        // Video::factory()->count(2)->for(Channel::factory()->forUser())->create();
    }
}
