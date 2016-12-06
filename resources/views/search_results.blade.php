@extends('layouts.app')
@section('title')
   Search
@endsection
@section('content')

<div class="container">
    @include('includes.message-block')
    @foreach($results as $result)

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <header><h3>Search Information</h3><hr></header>
            <section class="row new-post">
                <div class="col-sm-5">
                    <img src="{{ url('account-image',['filename' => $result->avatar])}}" alt="" class="img-responsive" style="width: 64px; height: 64px; border-radius: 50%; float: left">
                    <p style="padding-top: 20px; margin-left: 75px;"> <a href="{{ url('/profile',['user_id' => $result->id]) }}">{{ $result->name }}</a></p>
                </div>
            </section> 
        </div> 
    </div>
    @endforeach
</div>
@endsection
