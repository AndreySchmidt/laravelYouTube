<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
