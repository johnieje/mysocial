@extends('layouts.app')

@section('content')
@include('includes.message-block')
<div class="container">
    <section class="new-post">
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
            <article class="post">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, </p>
                <div class="info">
                    Posted by John on 11 11 2016
                </div>
                <div class="interaction">
                   <a href="">Like</a> | 
                   <a href="">Dislike</a> | 
                   <a href="">Edit</a> | 
                   <a href="">Delete</a>
                </div>
            </article>
            
            <article class="post">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, </p>
                <div class="info">
                    Posted by John on 11 11 2016
                </div>
                <div class="interaction">
                   <a href="">Like</a> | 
                   <a href="">Dislike</a> | 
                   <a href="">Edit</a> | 
                   <a href="">Delete</a>
                </div>
            </article>
        </div>
    </section>
</div>
@endsection
