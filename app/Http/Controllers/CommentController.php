<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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


        $attr['user_id'] = $request->user()->id;

        // если parent_id передан
        if($request->parent_id)
        {
            $attr['video_id'] = Comment::find($request->parent_id)->video_id;
        }

        return Comment::create($attr);
    }

    public function update(Comment $comment, Request $request)
    {
        // пользователь, который редактирует должен быть тем, кто оставил коммент
        // if($request->user()->isNot($comment->user))
        // {
        //     throw new AuthorizationException();
        // }

        // другой вариант аналогичной проверки
        // abort_if($request->user()->isNot($comment->user), 401, 'Unauthorized.');
        // abort_if($request->user()->isNot($comment->user), Response::HTTP_UNAUTHORIZED, 'Unauthorized.');

        // еще один способ
        throw_if($request->user()->isNot($comment->user), AuthorizationException::class);

        $attr = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->fill($attr)->save();
    }

    public function destroy(Comment $comment, Request $request)
    {
        throw_if($request->user()->isNot($comment->user), AuthorizationException::class);
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
}
