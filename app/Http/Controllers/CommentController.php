<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\Period;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        Gate::allowIf(fn (User $user) => $comment->isOwndBy($user) && $user->tokenCan('comment:update'));

        $attr = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->fill($attr)->save();
    }

    public function destroy(Comment $comment)
    {
        Gate::allowIf(fn (User $user) => $comment->isOwndBy($user) && $user->tokenCan('comment:delete'));
        
        $comment->delete();
    }

    public function index()
    {
        return Comment::withRelationships(request('with'))
        ->fromPeriod(Period::tryFrom(request('period')))
        ->search(request('text'))
        ->orderBy(request('sort', 'created_at'), request('order', 'desc'))
        ->simplePaginate(request('limit'))
        ->withQueryString();
    }

    public function show(Comment $comment)
    {
        return $comment->loadRelationships(request('with'));
    }
}
