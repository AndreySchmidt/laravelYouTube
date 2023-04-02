<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;

use App\Models\Playlist;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;


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

    public function scopeWithRelationships($query, array|string $with)
    {
        // усли $with строка, преобразую в массив Arr::wrap($with)

        $relationships = ['videos', 'playlists', 'user'];
        return $query->with(array_intersect(Arr::wrap($with), $relationships));
    }
}
