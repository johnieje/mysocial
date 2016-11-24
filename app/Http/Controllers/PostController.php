<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get(); //list all post  starting with last posted
        
        return view('home', ['posts' => $posts]);
    }
    
    public function postCreatePost(Request $request){
        //validate here
        $this->validate($request, [
            'post-body' => 'required|max:1000'
        ]);
        
        $post = new Post; //create new post instance
        $post->body = $request['post-body'];
        if($request->user()->posts()->save($post)){// save post as current user
            $message_success = "Your post has been successfully created";
            return redirect()->route('home')->with(['message-success' => $message_success]);
        }else{
            $message_fail = "An error occurred while creating your post! Try again.";
            return redirect()->route('home')->with(['message-fail' => $message_fail]);
        }   
    }
    
    public function getDeletePost($post_id){
        $post = Post::where('id', $post_id)->first(); //get post to delete
        if(Auth::user() != $post->user){
            return redirect()->route('home')->with(['message-fail' => 'You are not allowed to delete this post!']);
        }
        if($post->delete()){
            return redirect()->route('home')->with(['message-success' => 'Post successfully deleted']);
        }else{
            return redirect()->route('home')->with(['message-fail' => 'Sorry, An error ocurred while deleting post. Please try again!']);
        }
    }
    
    public function postEditPost(Request $request){
        $this->validate($request, [
            'body' => 'required|max:1000' //from ajax request
        ]);
        
        $post = Post::find($request['postId']);
        $post->body = $request['body'];
        $post->update();
        
        return response()->json(['new-body' => $post->body], 200);
    }
    
    public function postLikePost(Request $request){
        $post_id = $request['postId'];
        $is_like = $request['isLike']  == 'true' ? true : false;
        $update = null;
        
        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if($like){
            $likes = $like->like;
            $update = true;
            
            if($likes == $is_like){
                $like->delete();
                return null;
            }
        }else{
            $like = new Like();
        }
        
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        
        if($update){
            $like->update();
        }else{
            $like->save();
        }
        
        return null;
    }
    
}