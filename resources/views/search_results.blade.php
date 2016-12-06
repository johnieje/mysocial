@extends('layouts.app')
@section('title')
   Search
@endsection
@section('content')

<div class="container">
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach($results as $result)
                <p>{{ $result->name }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection
