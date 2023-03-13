<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index()
    {
        // получить список каналов
        // return Channel::get();

        // получить список каналов со списком видео по каналу with('videos') (videos - метод в модели) и пользовательскими данными
        // можно так with(['user', 'videos']) или так with('user', 'videos')
        return Channel::with(['user', 'videos'])->get();
    }

    public function show(Channel $channel)
    {
        // получить канал
        // return $channel;

        // получить канал со списком видео по каналу load('videos') (videos - метод в модели) и пользовательскими данными
        return $channel->load(['user', 'videos']);
    }
}
