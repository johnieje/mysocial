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
        $this->validate($request, [
            'post-body' => 'required|max:1000'
        ]);
        
        $post = new Post; //create new post instance
        $post->body = $request['post-body'];
        $message = "An error occurred while creating your post! Try again.";
        if($request->user()->posts()->save($post)){// save post as current user
            $message = "Your post has been successfully created";
        } 
        
        return redirect()->route('home')->with(['message' => $message]);
    }
}