<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Enums\Period;
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

        // switch (request('period'))
        // {
        //     case 'year': $arrVideoList = Video::where('created_at', '>=', now()->startOfYear())->get(); break;
        //     case 'month': $arrVideoList = Video::where('created_at', '>=', now()->startOfMonth())->get(); break;
        //     case 'week': $arrVideoList = Video::where('created_at', '>=', now()->startOfWeek())->get(); break;
        //     case 'day': $arrVideoList = Video::where('created_at', '>=', now()->startOfDay())->get(); break;
        //     case 'hour': $arrVideoList = Video::where('created_at', '>=', now()->startOfHour())->get(); break;
        //     default: $arrVideoList = Video::with('channel', 'categories')->get(); break;
        // }

        // рефакторинг свитча через матч
        // $arrVideoList = match(request('period'))
        // {
        //     'year' => Video::where('created_at', '>=', now()->startOfYear())->get(),
        //     'month' => Video::where('created_at', '>=', now()->startOfMonth())->get(),
        //     'week' => Video::where('created_at', '>=', now()->startOfWeek())->get(),
        //     'day' => Video::where('created_at', '>=', now()->startOfDay())->get(),
        //     'hour' => Video::where('created_at', '>=', now()->startOfHour())->get(),
        //     default => Video::with('channel', 'categories')->get(),
        // };

        // return $arrVideoList;

        // рефакторинг match
        // tryFrom вместо from ибо период может быть не указан http://localhost/api/videos?period=week
        // $objPeriod = Period::tryFrom(request('period'));
        
        // return $objPeriod
        //         ? Video::where('created_at', '>=', $objPeriod->date())->get()
        //         : Video::with('channel', 'categories')->get();


        $objPeriod = Period::tryFrom(request('period'));

        // методы моделей, которые начинаются со слова scope при вызове обращаться fromPeriod() 
        return Video::fromPeriod($objPeriod)
        
        // добавлю поиск по заголовку или описанию
        // ->where('title', '=', request('text')) если строгое равенство, то можно его не писать
        // ->where('title', request('text'))

        // для добавления скобок в запрос в БД надо сгруппировать ->where ->orWhere
        ->where(function ($query)
        {
            $query->where('title', 'like', '%'.request('text').'%')
            ->orWhere('description', 'like', '%'.request('text').'%');
        })
        ->get();
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
