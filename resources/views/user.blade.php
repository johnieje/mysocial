@extends('layouts.app')

@section('title')
    User Information
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
             <img src="{{ url('account-image',['filename' => $user->avatar])}}" alt="" class="img-responsive" style="width: 150px; height: 150px; border-radius: 50%; float: left"> 
                <div class="right">
                    <p style="padding-top: 30px"><h1>{{ $user->name }}</h1></p>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <hr>
            <h4>About</h4>
            
            <p>Email: {{ $user->email }}</p>
        </div>
    </div>
</div>

@endsection
