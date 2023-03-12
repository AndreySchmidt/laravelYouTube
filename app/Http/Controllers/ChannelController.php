<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index()
    {
        return Channel::get();
    }

    public function show(Channel $channel)
    {
        return $channel;
    }
}
