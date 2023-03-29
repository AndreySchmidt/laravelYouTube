<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *  ./vendor/bin/sail artisan db:seed --class=CategorySeeder
     */
    public function run(): void
    {
        // Category::factory()->count(10)->create();

        // $arrCategoryList = [];
        // foreach( range(1, 3) AS $intI ){

        //     $arrCategoryList[] = [
        //         'name' => 'arrCategoryList'.$intI,
        //     ];
        // }
        
        // if(!empty($arrCategoryList))
        // {
        //     DB::table('categories')->insert($arrCategoryList);
        // }

        # many to many start
        // создаем канал и пользователя (сразу линкуем к каналу) один-к-одному
        // $objChannelItem = Channel::factory()->forUser()->create();
        // создаем три видео  на канале (который создан ранее) один-ко-многим
        // $objVideoList = Video::factory(3)->for($objChannelItem)->create();
        // создаем категории и привязать к ним существующие видео (вставив коллекцию видео в метод hasAttached) многие-ко-многим
        // Category::factory(3)->hasAttached($objVideoList)->create();
        # many to many end


        # inverse many to many start
        // создаем канал и пользователя (сразу линкуем к каналу) один-к-одному
        $objChannelItem = Channel::factory()->forUser()->create();
        // создаем одно видео на канале (который создан ранее) один-ко-многим, тут только одно видео, но всё же ))
        // создаю и линкую две категории с видео
        // (hasCategories для работы метода требуется наличие метода categories в модели видео, который возвращает объект отношения)
        $objVideoList = Video::factory()->for($objChannelItem)->hasCategories(2)->create();

        # inverse many to many end
    }
}
