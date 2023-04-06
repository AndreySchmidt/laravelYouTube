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
        // Video::take(3)->get()->each(
        //     fn ( Video $video) => Comment::factory(4)->create(['video_id' => $video->id])
        // );

        // Video::take(2)->get()->each(
        //     fn (Video $video) => $this->forVideo($video)
        // );

        Video::take(2)->get()
            ->flatMap(fn (Video $video) => $this->forVideo($video)// родительский коммент к видео
            ->each(fn (Comment $comment) => $this->repliesOf($comment))// ответный коммент
        );
    }

    private function repliesOf(Comment $comment): void
    {
        Comment::factory(3)->for($comment->video)->for($comment, 'parent')->create();
    }

    // создать комменты (родительские и второго уровня) 
    // private function forVideo(Video $video): void
    // {
    //     Comment::factory(2)->for($video)->create()->each(
    //         fn (Comment $comment) => $this->repliesOf($comment)
    //     );
    // }

    // создать только родительские комменты 
    private function forVideo(Video $video)
    {
        return Comment::factory(2)->for($video)->create();
    }
}
