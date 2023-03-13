<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Video;

class Channel extends Model
{
    use HasFactory;

    // один ко многим (у одного канала много видео) получить видео по каналу
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
