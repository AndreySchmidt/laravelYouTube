<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * sudo ./vendor/bin/sail artisan db:seed --class=CommentSeeder
     */
    public function run(): void
    {
        Video::take(3)->get()
            ->flatMap(fn (Video $video) => static::seedCommentsFor($video))
            ->each(fn (Comment $comment) => static::associateParentCommentWith($comment));
    }

    private static function findRandomCommentToBeParent(Comment $comment)
    {
        return $comment->video->comments()->doesntHave('parent')
            ->where('id', '<>', $comment->id)
            ->inRandomOrder()->first();
    }

    private static function seedCommentsFor(Video $video)
    {
        $comments = Comment::factory(3)->create();
        $video->comments()->saveMany($comments);
        return $comments;
    }

    // присвоим комменту родителя
    private static function associateParentCommentWith(Comment $comment)
    {
        // чтобы не было вложенных чейнингов с комментами (оставлю 2 уровня)
        if($comment->replies->isNotEmpty()) return;
        $comment->parent()->associate(static::findRandomCommentToBeParent($comment))->save();
    }
}
