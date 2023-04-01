<?php

namespace App\Models;

use App\Enums\Period;
use App\Models\Channel;
use App\Models\Category;
use App\Models\Playlist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    // обратное отношеие один ко многим (у одного канала много видео) получить канал по видео
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories()
    {
        // многие ко многим (короткая версия потому, что следую соглашению по именованию пивота)
        return $this->belongsToMany(Category::class);
        // $this->belongsToMany(Category::class, 'category_video', 'video_id', 'category_id');
    }

    // методы моделей, которые начинаются со слова scope интерпретируются особым образом
    // в них есть ограничение при запросах в БД 
    // при вызове обращаться fromPeriod() 
    // они автоматически первым параметром принимают объект конструктора запросов $query
    // ограничим выорку по столбцу created_at
    // ?Period $period параметр период не обязателен
    public function scopeFromPeriod($query, ?Period $period)
    {
        // если период публикации видео был указан,
        // то на объекте конструктора запросов указывает ограничение выборки по столбцу created_at
        // если период не указан, то вернем объект конструктора запросов без ограничений
        return $period ? $query->where('created_at', '>=', $period->date()) : $query;
    }

    public function scopeSearch($query, ?string $text)
    {
        // если период публикации видео был указан,
        // то на объекте конструктора запросов указывает ограничение выборки по столбцу created_at
        // если период не указан, то вернем объект конструктора запросов без ограничений
        return $query->where(function ($query) use ($text)
                {
                    $query->where('title', 'like', "%$text%")
                    ->orWhere('description', 'like', "%$text%");
                });
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}
