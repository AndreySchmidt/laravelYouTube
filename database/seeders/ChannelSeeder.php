<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ./vendor/bin/sail artisan db:seed --class=ChannelSeeder
     */
    public function run(): void
    {
        // Channel::factory()->count(5)->create();

        // обратное отношение один к одному
        Channel::factory()->for(User::factory())->create();
        // обратное отношение один к одному с магических методом
        // (который должен быть в модели канала по работе с пользователем) с переопределением полей с помощью ассоц массивов
        Channel::factory()->forUser(['name'=>'User Name'])->create(['name'=>'Name Channel Somename']);


    //     $arrChannelList = [];
    //     foreach( range(1, 3) AS $intI ){
    //         $arrChannelList[] = [
    //             'name' => 'arrChannelList'.$intI,
    //             'user_id' => $intI,
    //         ];
    //     }

    //     if(!empty($arrChannelList))
    //     {
    //         DB::table('channels')->insert($arrChannelList);
    //     }
    }
}
