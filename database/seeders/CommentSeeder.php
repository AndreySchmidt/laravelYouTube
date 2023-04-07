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
        Video::take(2)->get()
            ->flatMap(fn (Video $video) => $this->forVideo($video)// родительский коммент к видео
            ->flatMap(fn (Comment $comment) => $this->repliesOf($comment))// ответный коммент
            ->flatMap(fn (Comment $comment) => $this->repliesOf($comment))// ответный коммент на предидущий ответный коммент
            ->flatMap(fn (Comment $comment) => $this->repliesOf($comment))// ответный коммент на предидущий ответный коммент
        );
    }

    private function repliesOf(Comment $comment)
    {
        return Comment::factory(2)->for($comment->video)->for($comment, 'parent')->create();
    }

    // создать только родительские комменты 
    private function forVideo(Video $video)
    {
        return Comment::factory(2)->for($video)->create();
    }
}
