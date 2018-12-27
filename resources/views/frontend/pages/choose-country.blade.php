@extends('frontend.country')
@section('content')

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="search-get-ride">
                    <form method="post" action="{{ url('/choose-country') }}">
                        {{ csrf_field() }}
                        <div class="form-group country-search">
                            <select name="country" id="" class="get-select-picker form-control" title="Country" required="">
                                @foreach($countries as $cr)
                                    <option value="{{ $cr->code.','.$cr->lat.','.$cr->lng }}">{{ $cr->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group country-search">
                            <input type="submit" class="btn btn-offer form-control" value="Select">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- about us -->
    <div class="get-about-us clearfix">
        <div class="container">
            <div class="row">
                <h2 class="get-about-us-title">Go Literally <span>anywhere.</span> <br> from <span>everywhere.</span></h2>
                <div class="col-sm-3 padding-left-o">
                    <div class="get-single-text clearfix">
                        <div class="icon"><img class="icon-1" src="{{ asset('public/assets/frontend/img/icon-1.png') }}" alt="icon-1"></div>
                        <h3 class="get-single-title">Smart</h3>
                        <p>User friendly people powered online marketplace. A community built on trust, for the users, by the users.</p>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="get-single-text clearfix">
                        <div class="icon"><img class="icon-2" src="{{ asset('public/assets/frontend/img/icon-2.png') }}" alt="icon-2"></div>
                        <h3 class="get-single-title">Simple</h3>
                        <p>Just as you like, anywhere, anytime at the cost acceptable to you.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="get-single-text clearfix">
                        <div class="icon"><img class="icon-3" src="{{ asset('public/assets/frontend/img/icon-3.png') }}" alt="icon-3"></div>
                        <h3 class="get-single-title">Seamless</h3>
                        <p>Search, book, communicate and enjoy the ride.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about us -->

    @endsection
