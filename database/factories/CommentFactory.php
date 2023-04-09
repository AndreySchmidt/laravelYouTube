<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    // после создания коммента перед записью в БД вызывается спец метод для связывание комментов с родительским
    // public function configure() этот слушатель больше не нужен, связываю в сидере
    // {
    //     return $this->afterCreating(function (Comment $comment){
    //         if($comment->replies()->exists()) return;
    //         $comment->parent()->associate($this->findRandomCommentToBeParent($comment))->save();
    //     });
    // }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => fake()->sentence(mt_rand(1, 3), true),
            'user_id' => User::inRandomOrder()->first() ?: User::factory(),
            'video_id' => Video::inRandomOrder()->first() ?: Video::factory(),
        ];
    }

    public function reply()//TODO странно, но пока не корректно работает в тинкер
    {
        return $this->state(function(){
            return ['parent_id' => Comment::inRandomOrder()->first() ?: Comment::factory(),];
        });
    }

    // private function findRandomCommentToBeParent(Comment $comment)
    // {
    //     return $comment->video->comments()->doesntHave('parent')
    //         ->where('id', '<>', $comment->id)
    //         ->inRandomOrder()->first();
    // }
}
