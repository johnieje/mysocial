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
                <article class="post" data-postid="{{ $post->id}} ">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                       <a href="">Like</a> | 
                       <a href="">Dislike</a> | 
                       <a href="#" class="edit">Edit</a> | 
                       <a href="{{ url('delete-post', ['post_id' => $post->id]) }}">Delete</a>
                    </div>
                </article>
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
<script>
    var urlEdit = '{{ url("edit-post") }}';
    var token = '{{ Session::token() }}';
</script>
@endsection
