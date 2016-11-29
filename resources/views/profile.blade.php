@extends('layouts.app')
@section('title')
   Profile - {{ $user->name }}
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
                            <img src="{{ url('account-image',['filename' => $user->avatar])}}" alt="" class="img-responsive">
                        </div>
                        <div class="right">
                            <label for="post-body" style="margin-left: 10px">Write a new post</label>                        
                            <textarea name="post-body" id="post-body" rows="3" class="form-control" placeholder="Write your post here..." style=""></textarea>
                        </div>                  
                    </div> 
                    <button type="submit" class="btn btn-primary pull-right">Create Post</button>
                </form>
            </div>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-10 col-md-offset-1">
            <header><h3>Your posts...</h3></header>
            @foreach($posts as $post)
            <a href="{{ url('/profile', ['user_id' => Auth::user()->id]) }}"><img src="{{ url('account-image',['filename' => $post->user->avatar])}}" alt="" class="img-responsive" ></a>
            
                <article class="post" id="body" data-postid="{{ $post->id}} "><a href="{{ url('/profile', ['user_id' => Auth::user()->id]) }}">{{ $post->user->name }}</a><p>{{ $post->body }}</p>                    
                    <div class="info"></br>
                        Posted on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                       <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? "You like this post" : "Like" : "Like" }}</a> | 
                       <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? "You don\'t like this post" : "Dislike" : "Dislike" }}</a> 
                        @if( Auth::user() == $post->user)
                        |
                        <a href="#" class="edit">Edit</a> | 
                       <a href="{{ url('delete-post', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                       
                    </div>
                </article>
            <hr>
            @endforeach
        </div>
        
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
          <form>
                <div class="form-group">
                    <label for="edit-body">Edit your post</label>
                    <textarea name="edit-body" id="edit-body" rows="5" class="form-control"></textarea>
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-modal">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var urlEdit = '{{ url("edit-post") }}';
    var urlLike = '{{ url("like-post") }}';
    var token = '{{ Session::token() }}';
</script>
@endsection