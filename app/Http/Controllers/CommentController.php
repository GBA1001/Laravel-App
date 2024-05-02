<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Services\EmailService;
use Illuminate\Http\Response;


class CommentController
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function add(Request $request, $postId, $commentable_id, $commentable_type)
    {
        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = Auth::id(); 
        $comment->content = $request->input('content');
        $comment->commentable_id = $commentable_id;
        $comment->commentable_type = $commentable_type;
        $comment->save();
        $comments = Comment::where('post_id', $postId)->get();
        $commentSection = '<div id="commentSection">';
        foreach ($comments as $comment) {
            $user = User::find($comment->user_id);
            $commentSection .= '<div>';
            $commentSection .= '<p>' . $comment->content . '</p>';
            $commentSection .= '<p>' . $comment->created_at . '</p>';
            $commentSection .= '<a href="' . url('/profile', $user->id) . '"><p>' . $user->name . '</p></a>';
            $commentSection .= '</div>';
        }
        $commentSection .= '</div>';
        $currentPost = Post::findOrFail($postId);
        $postUserId = $currentPost->user_id;
        $postOwner = User::findOrFail($postUserId);
        $recipient = $postOwner->email;
        $subject = 'See who just added a new comment';
        $body = 'This is the new comment added to your post ' . $request->input('content');
        $this->emailService->sendEmail($recipient, $subject, $body);
        return response()->json(['success' => true, 'message' => 'comment added successfully', 'commentSection' => $commentSection]);
    }

    public function edit(Request $request, Comment $comment)
    {
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function reply(Request $request, $parentCommentId,$postId)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);
    
        $parentComment = Comment::findOrFail($parentCommentId);
    
        $reply = new Comment();
        $reply->content = $data['content'];
        $reply->user_id = auth()->id();
        $reply->commentable_id = $parentComment->id;
        $reply->commentable_type = 'Comment';
        $reply->post_id = $postId;
        $reply->save();
    
        return redirect()->back()->with('success', 'Reply added successfully.');
    }
    
}
