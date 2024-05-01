<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;


class PostController
{
    public function index () {
        $posts = new Post();
        $data['getRecord'] = $posts->getRecord();        
        return view('posts',$data);
    }
    public function detail ($id) {
        $post = new Post();
        $data['getPostRecord'] = $post->getPostRecord($id)->first(); 
        $comments = new Comment();
        $commentsData['getCommentsRecord'] = $comments->getCommentsRecord($id);
        return view('post',$data,$commentsData);
    }
    public function create(){
        return view('create');
    }
    public function save(Request $request)
    {  
        $userId = Auth::id();
        $post = new Post();
        $post->title = $request->title;
        $post->user_id = $userId;
        $post->description = $request->description;

        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }
        $post->content = $request->content;
        $post->save();

        $category = new Category();
        $category->post_id = $post->id; // Set the post_id foreign key
        $category->name = $request->category; // Retrieve category name from the request
        $category->save();

        $posts = new Post();
        $data['getRecord'] = $posts->getRecord();        
        return view('posts',$data);
       
    }
    public function edit ($id) {
        $post = new Post();
        $data['getPostRecord'] = $post->getPostRecord($id)->first(); 
        return view('edit',$data);
    }
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }
        if ($request->has('category')) {
            $category = Category::updateOrCreate(
                ['post_id' => $post->id],
                ['name' => $request->category]
            );
        }
        $post->save();
        return redirect()->route('post.list')->with('success', 'Post updated successfully.');
    }
    public function delete ($id) {
        $posts = new Post();
        $deleted=$posts->deletePost($id);
        if($deleted){
            $data['getRecord'] = $posts->getRecord();        
            return redirect()->route('post.list');  
        }else{
            echo "Not deleted";
        }
        
    }
    //
}
