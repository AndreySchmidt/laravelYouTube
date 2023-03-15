<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrUserList = [];
        foreach( range(1, 3) AS $intI ){
            $arrUserList[] = [
                'name' => 'Name'.$intI,
                'email' => 'email'.$intI.'@email.ru',
                'password' => 'password'.$intI
            ];
        }

        if(!empty($arrUserList))
        {
            DB::table('users')->insert($arrUserList);
        }
    }
}
