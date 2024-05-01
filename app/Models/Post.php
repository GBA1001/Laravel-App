<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'post';
   
    public function getRecord () {
        return self::select('post.*', 'user.name as user_name', 'category.name as category_name')
        ->join('user', 'user.id', '=', 'post.user_id')
        ->join('category', 'category.post_id', '=', 'post.id')
        ->orderBy('post.id', 'desc')
        ->paginate(20);
    }
    public function getPostRecord($id) {
        return $this->select(
                'post.*',
                'user.name as user_name',
                'category.name as category_name',
            )
            ->join('user', 'user.id', '=', 'post.user_id')
            ->join('category', 'category.post_id', '=', 'post.id')
            ->leftJoin('comment', 'comment.post_id', '=', 'post.id') 
            ->where('post.id', '=', $id)
            ->get();
    }
    public function deletePost ($id) {
        $post = Post::find($id);
        if ($post) {
            return $post->delete(); 
        }
        return false; 
    }   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function category()
    {
        return $this->hasOne(Category::class, 'post_id');
    }
   
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
 
}
