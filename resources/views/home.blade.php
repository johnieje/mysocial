@extends('layouts.app')

@section('content')

<div class="container">
   
    <section class="new-post">
         @include('includes.message-block')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form action="{{ url('createpost') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="post-body">Write a new post</label>
                        <textarea name="post-body" id="post-body" rows="5" class="form-control" placeholder="Write your post here..."></textarea>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-10 col-md-offset-1">
            <header><h3>More posts...</h3></header>
            @foreach($posts as $post)
                <article class="post">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                       <a href="">Like</a> | 
                       <a href="">Dislike</a> | 
                       <a href="">Edit</a> | 
                       <a href="">Delete</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>
@endsection
