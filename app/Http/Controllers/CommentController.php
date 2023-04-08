<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Comment;
use Illuminate\Http\Request;

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

    public function index()
    {
        return Comment::with('parent', 'user', 'video')->get();
    }

    public function show(Comment $comment)
    {
        return $comment;
    }
}
