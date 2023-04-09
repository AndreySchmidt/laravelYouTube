<?php

namespace App\Models;

use App\Models\User;
use App\Enums\Period;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// sudo ./vendor/bin/sail artisan tinker

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected static $relationships = ['video', 'user'];

    // слушатель перед сохранением коммента после create
    protected static function booted()
    {
        static::saving(function (Comment $comment){

            $comment->user_id = $comment->user_id ?: auth()->id();

            // если parent_id передан
            if($comment->parent_id)
            {
                $comment->video_id = Comment::find($comment->parent_id)->video_id;
            }
        });
    }

    public function parent()
    {
        // обратное один ко многим .. можно на самого себя, а можно статик использовать (позднее связывание, будет указывать на эту модель)
        // return $this->belongsTo(Comments::class);
        return $this->belongsTo(static::class);
    }

    public function scopeFromPeriod($query, ?Period $period)
    {
        return $period ? $query->where('created_at', '>=', $period->date()) : $query;
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where('text', 'like', "%$text%");
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function isOwndBy(User $user)
    {
        // $user->id === $comment->user_id
        return $this->user_id === $user->id;
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
