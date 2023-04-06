<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// sudo ./vendor/bin/sail artisan tinker

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

    // public function replies()
    // {
    //     return $this->hasMany(static::class, 'parent_id');
    // }

    // private function findRandomCommentToBeParent()
    // {
    //     return $this->video->comments()->doesntHave('parent')
    //         ->where('id', '<>', $this->id)
    //         ->inRandomOrder()->first();
    // }

    // // присвоим комменту родителя
    // public function associateParentComment()
    // {
    //     // чтобы не было вложенных чейнингов с комментами (оставлю 2 уровня)
    //     // if($this->replies->isNotEmpty()) return;
    //     if($this->replies()->exists()) return;
    //     $this->parent()->associate($this->findRandomCommentToBeParent())->save();
    // }
}
