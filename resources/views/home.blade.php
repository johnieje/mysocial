@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="post" action="">
                <div class="form-group">
                    <label for="post-body">Write a new story</label>
                    <textarea name="post-body" id="post-body" rows="5" class="form-control" placeholder="Share your story here..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Share</button>
            </form>
        </div>
    </div>
</div>
@endsection
