@extends('frontend.layout')
@section('content')

    <!-- get join with us -->

    <div class="get-join-with-us">
        <div class="container">
            <div class="row">
                <div class="join-section-title">
                    <h2>Join</h2>
                    <h3>Us Today!</h3>
                </div>
                <div class="col-sm-12 get-join-as">
                    <h3 class="get-join-tag">Join as</h3>
                    <div class="col-sm-5">
                        <a href="{{ url('/sign-up/driver') }}">Ridemates (Driver)</a>
                    </div>
                    <div class="col-sm-2">
                        <span class="cd-ortext">Or</span>
                    </div>
                    <div class="col-sm-5">
                        <a href="{{ url('/sign-up/customer') }}" class="riders">Riders (Passenger)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection