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
        // сообщение высшего порядка
        // Video::take(3)->get()
        //     ->flatMap
        //     ->createRandomCommentList(3)
        //     ->each
        //     ->associateParentComment();

        Video::take(3)->get()->each(
            fn ( Video $video) => Comment::factory(4)->create(['video_id' => $video->id])
        );
    }

}
