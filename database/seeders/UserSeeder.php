<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Channel;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * ./vendor/bin/sail artisan db:seed --class=UserSeeder
     */
    public function run(): void
    {
        // создать и записать в БД
        User::factory(5)->create();

        // создать НО НЕ записать в БД
        // User::factory()->count(3)->make();

        // создать и записать в БД одну запись без таймстемпов (withoutTimestamps) и подтвержденной почты (unverified)
        // User::factory()->count(1)->unverified()->withoutTimestamps()->create();

        // создать пользователя, канал  и прикрутить этот канал к пользователю one-to-one
        // для того чтобы это сработало в модели пользователя должен быть метод public function channel()
        // User::factory()->has(Channel::factory())->create();

        // аналогом записи User::factory()->has(Channel::factory())->create(); является вариант (hasChannel, где Channel это метод в модели User)
        // User::factory()->hasChannel()->create();
        // так же можно переопределять некоторые поля, передавая их в аргументах массива
        // User::factory()->hasChannel()->create(['name' => 'Some Name']);



        // $arrUserList = [];
        // foreach( range(1, 3) AS $intI ){
        //     $arrUserList[] = [
        //         'name' => 'Name'.$intI,
        //         'email' => 'email'.$intI.'@email.ru',
        //         'password' => 'password'.$intI
        //     ];
        // }

        // if(!empty($arrUserList))
        // {
        //     DB::table('users')->insert($arrUserList);
        // }
    }
}
