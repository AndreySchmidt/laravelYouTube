<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Channel;

class Video extends Model
{
    use HasFactory;

    // обратное отношеие один ко многим (у одного канала много видео) получить канал по видео
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
