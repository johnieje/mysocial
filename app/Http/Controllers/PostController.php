<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

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
        $posts = Post::all();
        
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
        
        if($post->delete()){
            return redirect()->route('home')->with(['message-success' => 'Post successfully deleted']);
        }else{
            return redirect()->route('home')->with(['message-fail' => 'Sorry, An error ocurred while deleting post. Please try again!']);
        }
    }
}