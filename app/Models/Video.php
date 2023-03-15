<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Channel;
use App\Models\Category;

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
}
