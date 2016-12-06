@extends('layouts.app')
@section('title')
   Search
@endsection
@section('content')

<div class="container">
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <header><h3>Search Results: {{ $count }} {{ str_plural('record', $count) }} found. </h3><hr></header>
            @foreach($results as $result)
            <section class="row new-post">
                <div class="col-sm-5">
                    <a href="{{ url('/user',['id' => $result->id]) }}">
                    <img src="{{ url('account-image',['filename' => $result->avatar])}}" alt="" class="img-responsive" style="width: 64px; height: 64px; border-radius: 50%; float: left">
                    <p style="padding-top: 20px; margin-left: 75px;"> {{ $result->name }}</p>
                    </a>                        
                </div>
            </section>
            @endforeach
        </div> 
    </div>
</div>
@endsection
