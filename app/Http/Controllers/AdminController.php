<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class AdminController
{
    public function dashboard()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('post.list')->with('error', 'You do not have permission to access this page.');
        }
        $posts = Post::all();
        $comments = Comment::all();
        return view('admin', ['posts' => $posts, 'comments' => $comments]);

    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
