<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    public function postCreatePost(Request $request){
        //validate here
        
        $post = new Post; //create new post instance
        $post->body = $request['post-body'];
        $request->user()->posts()->save($post); // save post as current user
        
        return redirect()->route('home');
    }
}