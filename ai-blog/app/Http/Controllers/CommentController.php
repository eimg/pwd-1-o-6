<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate(['content' => ['required', 'string', 'min:3', 'max:2000']]);
        $post->comments()->create(['content' => $data['content'], 'user_id' => $request->user()->id]);

        return back()->with('success', 'Comment added.');
    }

    public function destroy(Request $request, Comment $comment): RedirectResponse
    {
        abort_unless($comment->user_id === $request->user()->id, 403);
        $comment->delete();

        return back()->with('success', 'Comment removed.');
    }
}
