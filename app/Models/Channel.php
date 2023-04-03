<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;

use App\Models\Playlist;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;
    protected static $relationships = ['videos', 'playlists', 'user'];


    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    // один ко многим (у одного канала много видео) получить видео по каналу
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    // обратное отношение один к одному
    public function user()
    {
        return $this->belongsTo(User::class);
        // return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function scopeSearch($query, ?string $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

}
