<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();

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
    }
}
