<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use App\Models\Channel;

// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ./vendor/bin/sail artisan db:seed --class=ChannelSeeder
     */
    public function run(): void
    {
        Channel::factory(5)
        // для того чтобы не было проблем с сидированием каналов
        // (1 канал - один пользователь) надо сидировать равное количество каналов и пользователей (там сделать 5)
        ->sequence(fn ($sequence) => ['user_id' => $sequence->index + 1])
        ->create();

        // обратное отношение один к одному
        // Channel::factory()->for(User::factory())->create();
        
        // обратное отношение один к одному с магических методом
        // (который должен быть в модели канала по работе с пользователем) с переопределением полей с помощью ассоц массивов
        // Channel::factory()->forUser(['name'=>'User Name'])->create(['name'=>'Name Channel Somename']);


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



        // Один-ко-Многим
        // создать канал + пользователя + связать их + создать три видео на канале
        // на модели канала должен быть метод videos он будет вызван для создания видео к каналу
        // Channel::factory()->forUser()->has(Video::factory(3))->create();

    }
}
