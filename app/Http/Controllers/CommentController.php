<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $attr = $request->validate([
            'text' => 'required|string',
            'parent_id' => 'exists:comments,id',
            'video_id' => 'required_without:parent_id|exists:videos,id',
        ]);

        return Comment::create($attr);
    }

    public function update(Comment $comment, Request $request)
    {
        // $this->checkPermissions($comment, $request);
        // Gate::allowIf(fn (User $user) => $user->is($comment->user));
        Gate::allowIf(fn (User $user) => $comment->isOwndBy($user));

        $attr = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->fill($attr)->save();
    }

    // public function destroy(Comment $comment, Request $request)
    public function destroy(Comment $comment)
    {
        // $this->checkPermissions($comment, $request);
        // Gate::allowIf(fn (User $user) => $user->is($comment->user));
        // Gate::allowIf(fn (User $user) => $user->id === $comment->user_id);
        Gate::allowIf(fn (User $user) => $comment->isOwndBy($user));
        
        $comment->delete();
    }

    public function index()
    {
        return Comment::with('parent', 'user', 'video')->get();
    }

    public function show(Comment $comment)
    {
        return $comment;
    }

    // private function checkPermissions(Comment $comment, Request $request)
    // {
    //     throw_if($request->user()->isNot($comment->user), AuthorizationException::class);
    // }
}
