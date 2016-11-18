@extends('layouts.app')

@section('title')
    This is an individual page title
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <form action="{{ url('account-save') }}" method="post" enctype="multipart/form-data">
              <header><h3>Account Information</h3><hr></header>
              <div class="form-group">
                <label for="email">Your Email</label>
                <div>{{ $user->email }}</div>
              </div>
              
              <div class="form-group">
                <label for="full_name">Your Name</label>
                <input type="text" class="form-control" id="full_name" aria-describedby="nameHelp" value="{{ $user->name }}">
              </div>

              <div class="form-group">
                <label for="photo">Upload a photo</label>
                <input type="file" class="form-control-file" name="photo" id="photo" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Only jpeg/jpg format is allowed.</small>
              </div>
              <button type="submit" class="btn btn-primary">Update Account</button>
          </form>
        </div>
    </div>
</div>
@if(Storage::disk('local')->has($user->name . '-' . $user->id . '-' . '.jpg'))
<section class="row new-post">
    <div class="col-md-10 col-md-offset-1">
        <img src="{{ url('account-photo',['filename' => $user->name . '-' . $user->id . '-' . '.jpg'])}}" alt="" class="img-responsive">
    </div>
</section>
@endif
@endsection
