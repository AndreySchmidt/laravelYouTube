<?php

namespace App\Models;

use App\Models\Video;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected static $relationships = ['videos'];

    public function videos()
    {
        // многие ко многим (короткая версия потому, что следую соглашению по именованию пивота)
        return $this->belongsToMany(Video::class);
        // $this->belongsToMany(Video::class, 'category_video', 'category_id', 'video_id');
    }

    public function scopeSearch($query, ?string $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

}
