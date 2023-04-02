<?php

namespace App\Models;

use App\Models\Channel;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory;

    public function scopeSearch($query, ?string $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function scopeWithRelationships($query, array|string $with)
    {
        // усли $with строка, преобразую в массив Arr::wrap($with)

        $relationships = ['channel', 'videos'];
        return $query->with(array_intersect(Arr::wrap($with), $relationships));
    }
}
