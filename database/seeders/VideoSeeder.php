<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrVideoList = [];

        foreach( range(1, 3) AS $intI ){

            $arrVideoList[] = [
                'title' => 'arrVideoList'.$intI,
                'channel_id' => $intI,
            ];
        }

        if(!empty($arrVideoList))
        {
            DB::table('videos')->insert($arrVideoList);
        }
    }
}
