<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index()
    {
        return Channel::withRelationships(request('with', []))
        ->search(request('name'))
        ->orderBy(request('sort', 'name'), request('order', 'asc'))
        ->simplePaginate(request('limit'))
        ->withQueryString();

        // return Channel::with(['user', 'videos'])->get();
    }

    public function show(Channel $channel)
    {
        return $channel->load(request('with', []));
    }
}
