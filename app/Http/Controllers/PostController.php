<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Like;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Nicetime;

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
        
        return view('home', ['posts' => $posts, 'user' => Auth::user()]);
    }
    
    public function getProfilePosts($user_id){
        $posts = Post::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        
        return view('profile', ['posts' => $posts, 'user' => Auth::user()]);
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
    
    public function postCommentPost(Request $request){
        $this->validate($request, [
            'comment_body' => 'required|max:255'
        ]);
        
        $comment = new Comment;
        
        $user = Auth::user();
        $comment->comment = $request['comment_body'];
        $comment->post_id = $request['post_id'];
        $comment->user_id = $user->id;
        
        if($comment->save()){// save post as current user
            $message_success = "Your comment has been successfully created";
            return redirect()->route('home')->with(['message-success' => $message_success]);
        }else{
            $message_fail = "An error occurred while creating your comment! Try again.";
            return redirect()->route('home')->with(['message-fail' => $message_fail]);
        }
       
    }
    
    public function getCommentCount(Request $request){
        $post_id = $request['postId'];
        $results = Comment::where('post_id', $post_id)->get();
        $commentsArray[] = [
           'count' => count($results)
                //'avatar_path' => URL::asset($user->avatar_path)
        ];
        return response()->json($commentsArray);
    }
    
    public function getCommentsPost($post_id){
        $user = Auth::user();
        $post = Post::where('id', $post_id)->first();
        
        $comments = Comment::where('post_id', $post_id)->get();
        $count = count($comments);
        
        return view('comment', ['post' => $post, 'user' => $user, 'comments' => $comments, 'count' => $count]);
    }
    
}