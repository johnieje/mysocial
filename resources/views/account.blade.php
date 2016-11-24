@extends('layouts.app')

@section('title')
    Account
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <form action="{{ url('/accountupdate') }}" method="post" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <header><h3>Account Information</h3><hr></header>
              <div class="form-group">
                <label for="email">Your Email</label>
                <div>{{ $user->email }}</div>
              </div>
              
              <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{ $user->name }}">
              </div>

              <div class="form-group">
                <label for="image">Upload a photo</label>
                <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Only jpeg/jpg format is allowed.</small>
              </div>
              <button type="submit" class="btn btn-primary">Update Account</button>
          </form>
        </div>
    </div>

<section class="row new-post">
    <div class="col-md-10 col-md-offset-1">
        <img src="/uploads/avatars/{{ $user->avatar }}" alt="" class="img-responsive" style="width: 150px; height: 150px; border-radius: 50%; float: left">  
    </div>
</section>
   
</div>

@endsection
