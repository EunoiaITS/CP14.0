@include('frontend.includes.head')
@if(Auth::check())
    @include('frontend.includes.header-login')
@else
    @include('frontend.includes.header')
@endif
@include('frontend.includes.sidebar')
@yield('content')
@include('frontend.includes.footer')