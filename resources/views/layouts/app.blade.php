
@include('includes.header')

@yield('content')
    
@include('includes.footer', ['year' => date('Y')])
   