<?php

namespace App\Http\Controllers;

use App\Models\Playlist;

// sudo ./vendor/bin/sail artisan make:model Playlist -mfsc
class PlaylistController extends Controller
{
    public function index()
    {
        return Playlist::withRelationships(request('with'))
        ->search(request('name'))
        ->orderBy(request('sort', 'name'), request('order', 'asc'))
        ->simplePaginate(request('limit'))
        ->withQueryString();
    }

    public function show(Playlist $playlist)
    {
        return $playlist->loadRelationships(request('with'));
    }
}
