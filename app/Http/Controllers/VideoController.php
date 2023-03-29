<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Enums\Period;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        return Video::with(request('with', []))
        ->fromPeriod(Period::tryFrom(request('period')))
        ->search(request('text'))
        ->orderBy(request('sort', 'created_at'), request('order', 'desc'))
        // чтобы он подтягивал категории и тд нужно вызвать на пагинаторе withQueryString()
        // ->paginate(request('limit'))
        // если хочу вывести пагинацию вперед-назад (без страниц) то другой метод пагинации
        ->simplePaginate(request('limit'))
        ->withQueryString();
    }

    public function show(Video $video)
    {
        // return $video->load('channel', 'categories');
        // вместо подгрузки каждый раз канала и категорий, буду читать нужны ли они из реквеста
        // ?with[]=channel.user&with[]=categories например так
        return $video->load(request('with', []));
    }
}
