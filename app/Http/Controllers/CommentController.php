<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController
{
    public function add(Request $request, $postId){
        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = Auth::id(); // Get the authenticated user's ID
        $comment->content = $request->input('content');
        $comment->save();

        // Redirect back to the post detail page or wherever appropriate
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    //
}
