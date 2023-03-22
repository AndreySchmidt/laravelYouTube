<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        // верну количество записей видео относительно времени их добавления
        // return [
        //     'year' => Video::with('channel', 'categories')
        //     ->where('created_at', '>=', now()->startOfYear())
        //     ->count(),
        //     'month' => Video::with('channel', 'categories')
        //     ->where('created_at', '>=', now()->startOfMonth())
        //     ->count(),
        //     'week' => Video::with('channel', 'categories')
        //     ->where('created_at', '>=', now()->startOfWeek())
        //     ->count(),
        //     'day' => Video::with('channel', 'categories')
        //     ->where('created_at', '>=', now()->startOfDay())
        //     ->count(),
        //     'hour' => Video::with('channel', 'categories')
        //     ->where('created_at', '>=', now()->startOfHour())
        //     ->count(),
        // ];

        // return Video::with('channel', 'categories')
        //     ->where('created_at', '>=', now()->startOfYear())
        //     ->get();

        // верну данные по периоду (строка в гет параметрах)
        // http://localhost/api/videos?period=year
        // http://localhost/api/videos?period=week

        // $strPeriod = request('period');
        // if($strPeriod)
        // {
        //     $arrVideoList = [
        //         'year' => Video::with('channel', 'categories')
        //         ->where('created_at', '>=', now()->startOfYear())
        //         ->get(),
        //         'month' => Video::with('channel', 'categories')
        //         ->where('created_at', '>=', now()->startOfMonth())
        //         ->get(),
        //         'week' => Video::with('channel', 'categories')
        //         ->where('created_at', '>=', now()->startOfWeek())
        //         ->get(),
        //         'day' => Video::with('channel', 'categories')
        //         ->where('created_at', '>=', now()->startOfDay())
        //         ->get(),
        //         'hour' => Video::with('channel', 'categories')
        //         ->where('created_at', '>=', now()->startOfHour())
        //         ->get(),
        //     ];
        //     return $arrVideoList[$strPeriod];
        // }

        switch (request('period'))
        {
            case 'year': $arrVideoList = Video::where('created_at', '>=', now()->startOfYear())->get(); break;
            case 'month': $arrVideoList = Video::where('created_at', '>=', now()->startOfMonth())->get(); break;
            case 'week': $arrVideoList = Video::where('created_at', '>=', now()->startOfWeek())->get(); break;
            case 'day': $arrVideoList = Video::where('created_at', '>=', now()->startOfDay())->get(); break;
            case 'hour': $arrVideoList = Video::where('created_at', '>=', now()->startOfHour())->get(); break;
            default: $arrVideoList = Video::with('channel', 'categories')->get(); break;
        }

        return $arrVideoList;
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
