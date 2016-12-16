@extends('layouts.app')
@section('title')
    Post Comments
@endsection
@section('content')
<div class="container">
        <section class="new-post">
         @include('includes.message-block')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form action="{{ url('createpost') }}" method="post">
                    {{ csrf_field() }}
                    
                    <div class="wrap form-group">
                        <div class="left">
                            <a href="{{ url('/profile', ['user_id' => Auth::user()->id]) }}"><img src="{{ url('account-image',['filename' => $user->avatar])}}" alt="" class="img-responsive"></a>
                        </div>
                        <div class="right">
                            <label for="post-body" style="margin-left: 10px">Write a new post</label>                        
                            <textarea name="post-body" id="post-body" class="form-control" style="height: 74px" placeholder="Write your post here..."></textarea>
                        </div>                  
                    </div> 
                    <button type="submit" class="btn btn-primary pull-right">Create Post</button>
                </form>
            </div>
        </div>
    </section>
    
    <section class="row posts">
        <div class="col-md-10 col-md-offset-1">
            <header><h3>Post...</h3></header>
            <a href="{{ url('/profile', ['user_id' => Auth::user()->id]) }}"><img src="{{ url('account-image',['filename' => $post->user->avatar])}}" alt="" class="img-responsive" ></a>
            <article class="" id="body" data-postid="{{ $post->id}} "><a href="{{ url('/profile', ['user_id' => Auth::user()->id]) }}">{{ $post->user->name }}</a><p id="comment">{{ $post->body }}</p>                    
                    <div class="info"></br>
                        Posted: 
                        {{ Nicetime::niceTime($post->created_at) }}
                    
                    </div>
                    <div class="interaction">
                       <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? "You like this post" : "Like" : "Like" }}</a> | 
                       <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? "You don\'t like this post" : "Dislike" : "Dislike" }}</a> 
                        @if( Auth::user() == $post->user)
                        |
                        <a href="#" class="edit">Edit</a> | 
                       <a href="{{ url('delete-post', ['post_id' => $post->id]) }}"><i class="fa fa-trash-o" aria-hidden="true"  title="Delete"></i></a>
                        
                        @endif
                       | <a href="{{ url('get-comments', ['post_id' => $post->id]) }}">{{ $count }} Comments</a>
                    </div>
                    @foreach($comments as $comment)
                        <article class="post">
                            <a href="{{ url('/profile', ['user_id' => $comment->user->id]) }}"><img src="{{ url('account-image',['filename' => $comment->user->avatar])}}" alt="" class="img-responsive" style="width:16px, height:16px" ></a>
                            <div>{{ $comment->comment }}</div>
                            <div class="info">Comment by {{ $comment->user->name }} {{ Nicetime::niceTime($comment->created_at) }}</div>
                        </article>
                    @endforeach
                    <div class="">
                        <form action="{{ url('comment') }}" class="post_comment" method="post">
                            <div class="input-group">
                               <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <textarea name="comment_body" id="comment_body" rows="1" class="form-control" placeholder="Write your comment here..."></textarea>
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-comment fa-lg" title="Post Comment"></i></button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </article>
        </div>
        
    </section>
</div>
@endsection