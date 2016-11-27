@extends('layouts.app')

@section('title')
    Account
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
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
        <div class="col-md-10 col-md-offset-1">
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
      <div class="col-md-10 col-md-offset-1">
      <hr>
        <p>Would you like to delete your account?</p>
        <a class="btn btn-danger" data-href="{{ url('/delete-account', ['id' => $user->id]) }}" data-toggle="modal" data-target="#confirm-delete" role="button">Delete Account</a>
      </div>
    </div>   
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete your account, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete Account</a>
                </div>
            </div>
        </div>
    </div>
@endsection
