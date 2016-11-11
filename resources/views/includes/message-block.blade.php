@if(count($errors) > 0)
<div class="row">
    <div class="col-md-10 col-md-offset-3">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@if(Session::has('message'))
<div class="row">
    <div class="col-md-10 col-md-offset-3">
        {{ Session::get('message') }}
    </div>
</div>
@endif