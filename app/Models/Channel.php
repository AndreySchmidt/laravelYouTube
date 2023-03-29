<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Video;
use App\Models\User;

class Channel extends Model
{
    use HasFactory;

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
