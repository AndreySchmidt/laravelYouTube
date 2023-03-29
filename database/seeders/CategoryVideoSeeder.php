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
     * ./vendor/bin/sail artisan db:seed --class CategoryVideoSeeder
     */

    public function run(): void // верну дурацкий ватиант в с решением лоб
    {
        $arrCategoryVideoPivotList = [];

        foreach( range(1, 3) AS $intI ){

            // не забывай, что в других сидерах есть втыкание связей, которые создают конфликт из-за формирование примари в пивоте
            // $arrCategoryVideoPivotList[] = [
            //     'category_id' => $intI,
            //     'video_id' => $intI,
            // ];
        }

        if(!empty($arrCategoryVideoPivotList))
        {
            DB::table('category_video')->insert($arrCategoryVideoPivotList);
        }
    }

    // public function run(): void
    // {
    //     // Всегда делай id в таблице )) тут его нет и могут быть ошибки при попытке встевить в таблицу дублирующиеся строки
    //     // либо id в таблицу, либо делать проверку перед вставкой, либо migration:refresh

    //     // // беру все id категории
    //     $categoryIds = Category::pluck('id');
    //     // беру все id видео
    //     $videoIds = Video::pluck('id');


    //     // так как $videoIds за пределами области видимости функции, то передаем её туда use ($videoIds) 
    //     // use предоставляет даступ к переменной за пределами тела функции, которую не передали как аргумент
    //     $categoryVideoPivotList = $categoryIds->map(function(int $id) use ($videoIds) {
    //         return [
    //             'category_id' => $id,
    //             'video_id' => $videoIds->random(),
    //         ];
    //     });

    //     // можно сократить с помощью стрелочной функции и не писать use он сам подтянет скоуп и найдет $videoIds наверху
    //     // $categoryVideoPivotList = $categoryIds->map(fn (int $id) =>  ['category_id' => $id, 'video_id' => $videoIds->random(),]);


    //     // })->dd(); хитрый dd() преобразовал объект коллекции в массив (если не отдельной функцией его запускать), но на самом деле там объект
    //     // , а в DB::table('category_video')->insert($categoryVideoPivotList); надо пихать именно массив или ошибку выдает
    //     // перед передачей данных на запись в БД, преобразую объект коллекции типа (Illuminate\Support\Collection) в массив методом ->all()
    //     // (->insert($categoryVideoPivotList->all());) для тех, кто в танке -- ->all() преобразует объект коллекции в массив,
    //     // а ->flatten() многоуровневую коллекцию (с вложенными объектами) в одноуровневую
    //     // (флэт короче, которому можно передать количество уровней, которые надо развернуть в плоский объект, по умолчанию все вложенные выводит в один уровень)
    //     // так же есть метод ->flatMap() среднее между ->map() и ->flatten(), но он уберает только один уровень вложенности (двухмерный объект в одномерный)
        
    //     if(!empty($categoryVideoPivotList))
    //     {
    //         // dd($categoryVideoPivotList->all());
    //         DB::table('category_video')->insert($categoryVideoPivotList->all());
    //     }
    
    // }


    // public function run(): void
    // {
    //     #s плохой вариант
    //     // // беру все id категории
    //     // // $objCategoryList = Category::pluck('id');// чтобы преобразовать объект (коллекция) в массив ->all()
    //     // $categoryIds = Category::pluck('id')->all();
    //     // // беру все id видео
    //     // // $objVideoList = Video::pluck('id');// чтобы преобразовать объект в массив ->all()
    //     // $videoIds = Video::pluck('id')->all();

    //     // $categoryVideoPivotList = [];
    //     // foreach($categoryIds AS $categoryId) {
    //     //     // возьму рандомные видео
    //     //     // это плохой варик ибо у меня нет id в табице пивота и примари формируется слиянием id video id category что является абсолютным злом
    //     //     // ибо практикой доказано, что id пихать надо всегда во все таблы, в том числе пивот
    //     //     $videoRandomList = Arr::random($videoIds, mt_rand(1, count($videoIds)));

    //     //     foreach($videoRandomList AS $videoRandomId) {

    //     //         $arrCategoryVideoPivotList[] = [
    //     //             'category_id' => $categoryId,
    //     //             'video_id' => $videoRandomId,
    //     //             // 'category_id' => $arrCategoryItem['id'],
    //     //             // 'video_id' => $arrVideoRandomItem['id'],
    //     //         ];
    //     //     }
    //     // }
        
    //     // if(!empty($arrCategoryVideoPivotList))
    //     // {
    //     //     DB::table('category_video')->insert($arrCategoryVideoPivotList);
    //     // }
    //     #e

    //     $arrCategoryVideoPivotList = [];

    //     foreach( range(1, 3) AS $intI ){

    //         $arrCategoryVideoPivotList[] = [
    //             'category_id' => $intI,
    //             'video_id' => $intI,
    //         ];
    //     }

    //     if(!empty($arrCategoryVideoPivotList))
    //     {
    //         DB::table('category_video')->insert($arrCategoryVideoPivotList);
    //     }
    // }
}
