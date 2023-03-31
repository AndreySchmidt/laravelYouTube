<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

// sudo ./vendor/bin/sail artisan make:model Playlist -mfsc
class PlaylistController extends Controller
{
    public function index()
    {
        return Playlist::with(request('with', []))
        ->search(request('name'))
        ->orderBy(request('sort', 'name'), request('order', 'asc'))
        ->simplePaginate(request('limit'))
        ->withQueryString();
    }

    public function show(Playlist $playlist)
    {
        return $playlist->load(request('with', []));
    }
}
