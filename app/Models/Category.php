<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Video;

class Category extends Model
{
    use HasFactory;

    public function videos()
    {
        // многие ко многим (короткая версия потому, что следую соглашению по именованию пивота)
        return $this->belongsToMany(Video::class);
        // $this->belongsToMany(Video::class, 'category_video', 'category_id', 'video_id');
    }
}
