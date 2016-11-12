@if(count($errors) > 0)
<div class="row">
    <div class="col-md-10 col-md-offset-1 alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@if(Session::has('message-success'))
<div class="row">
    <div class="col-md-10 col-md-offset-1 alert alert-success">
        {{ Session::get('message-success') }}
    </div>
</div>
@endif

@if(Session::has('message-fail'))
<div class="row">
    <div class="col-md-10 col-md-offset-1 alert alert-danger">
        {{ Session::get('message-fail') }}
    </div>
</div>
@endif