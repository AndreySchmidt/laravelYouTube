<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #s плохой вариант
        // // беру все id категории
        // // $objCategoryList = Category::pluck('id');// чтобы преобразовать объект (коллекция) в массив ->all()
        // $categoryIds = Category::pluck('id')->all();
        // // беру все id видео
        // // $objVideoList = Video::pluck('id');// чтобы преобразовать объект в массив ->all()
        // $videoIds = Video::pluck('id')->all();

        // $categoryVideoPivotList = [];
        // foreach($categoryIds AS $categoryId) {
        //     // возьму рандомные видео
        //     // это плохой варик ибо у меня нет id в табице пивота и примари формируется слиянием id video id category что является абсолютным злом
        //     // ибо практикой доказано, что id пихать надо всегда во все таблы, в том числе пивот
        //     $videoRandomList = Arr::random($videoIds, mt_rand(1, count($videoIds)));

        //     foreach($videoRandomList AS $videoRandomId) {

        //         $arrCategoryVideoPivotList[] = [
        //             'category_id' => $categoryId,
        //             'video_id' => $videoRandomId,
        //             // 'category_id' => $arrCategoryItem['id'],
        //             // 'video_id' => $arrVideoRandomItem['id'],
        //         ];
        //     }
        // }
        
        // if(!empty($arrCategoryVideoPivotList))
        // {
        //     DB::table('category_video')->insert($arrCategoryVideoPivotList);
        // }
        #e

        $arrCategoryVideoPivotList = [];

        foreach( range(1, 3) AS $intI ){

            $arrCategoryVideoPivotList[] = [
                'category_id' => $intI,
                'video_id' => $intI,
            ];
        }

        if(!empty($arrCategoryVideoPivotList))
        {
            DB::table('category_video')->insert($arrCategoryVideoPivotList);
        }
    }
}
