<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Comment::factory(5)->create();
        Video::take(3)->get()->flatMap(function (Video $video) {
            $comments = Comment::factory(3)->create();
            $video->comments()->saveMany($comments);

            // return $comments->pluck('id')->all();
            return $comments;
        })->each(function (Comment $comment){
            // чтобы не было вложенных чейнингов с комментами (оставлю 2 уровня)
            if($comment->replies->isNotEmpty()) return;

            $comment->parent()->associate(static::findRandomCommentToBeParent($comment))->save();
        });
    }

    public static function findRandomCommentToBeParent(Comment $comment)
    {
        return $comment->video->comments()->doesntHave('parent')
            ->where('id', '<>', $comment->id)
            ->inRandomOrder()->first();
    }
}
