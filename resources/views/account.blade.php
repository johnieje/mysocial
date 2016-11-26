@extends('layouts.app')

@section('title')
    Account
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <header><h3>Account Information</h3><hr></header>
            @if(Storage::disk('local')->has($user->name . '-' . $user->id . '-' . '.jpg'))
            <section class="row new-post">
                <div class="col-sm-5">
                    <img src="{{ url('account-image',['filename' => $user->name . '-' . $user->id . '-' . '.jpg'])}}" alt="" class="img-responsive" style="width: 150px; height: 150px; border-radius: 50%; float: left">
                    <div class="remove">
                        <a href="{{ url('/account/delete-image', ['filename' => $user->name . '-' . $user->id . '-' . '.jpg' ]) }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </div>
                </div>
            </section>
            @else
            <section class="row new-post">
                <div class="">
                    <img src="{{ url('account-image', ['filename' => $user->avatar])}}" alt="" class="img-responsive" style="width: 150px; height: 150px; border-radius: 50%; float: left">
                </div>
            </section>    
            @endif  
        </div>
        <div class="col-md-10">
          <form action="{{ url('/accountupdate') }}" method="post" enctype="multipart/form-data">
              {!! csrf_field() !!}
              
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

   
</div>

@endsection
