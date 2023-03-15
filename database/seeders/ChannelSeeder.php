<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrChannelList = [];
        foreach( range(1, 3) AS $intI ){
            $arrChannelList[] = [
                'name' => 'arrChannelList'.$intI,
                'user_id' => $intI,
            ];
        }

        if(!empty($arrChannelList))
        {
            DB::table('channels')->insert($arrChannelList);
        }
    }
}
