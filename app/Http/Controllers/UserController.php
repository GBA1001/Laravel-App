<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class UserController
{
    public function profile ($id) {
        $comments['getCommentsRecord'] = Comment::where('user_id', $id)->get();
        $posts['getPostsRecord'] = Post::where('user_id', $id)->get();
        return view('profile',$comments,$posts);
    }
    //
}
