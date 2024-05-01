<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'comment';
    public function getCommentsRecord($postId) {
        return $this->select('comment.*','user.name as user_name',)
        ->join('user', 'user.id', '=', 'comment.user_id')
        ->where('comment.post_id','=',$postId)
        ->get();
        
    }
    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

   
}