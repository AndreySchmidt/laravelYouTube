<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public function parent()
    {
        // обратное один ко многим .. можно на самого себя, а можно статик использовать (позднее связывание, будет указывать на эту модель)
        // return $this->belongsTo(Comments::class);
        return $this->belongsTo(static::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
