@extends('frontend.layout')
@section('content')

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="search-get-ride">
                    <form method="post" action="{{ url('/choose-country') }}">
                        {{ csrf_field() }}
                        <div class="form-group country-search">
                            <select name="country" id="" class="get-select-picker form-control" title="Country">
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


    <!-- todays departure -->
    <div class="get-departure clearfix">
        <div class="container">
            <div class="row">
                <h2 class="get-departure-title">Today's Departure</h2>
                <!-- single departure -->
                <div class="col-sm-6 col-xs-12 padding-left-o">
                    <div class="get-single-departure clearfix">
                        <div class="col-sm-8 ">
                            <div class="get-user-icon">
                                <img src="{{ asset('public/assets/frontend/img/user/user-1.jpg') }}" alt="">
                            </div>
                            <div class="get-user-details">
                                <h3 class="get-user-name"><span>Name <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">Jonson Martin</span></h3>
                                <h3 class="get-user-name"><span>Age <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">26</span></h3>
                                <h3 class="get-user-name"><span>Seats Available <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name"></span></h3>
                                <ul class="get-user-icon-layer">
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="get-user-ratings">
                                <ul class="get-rate-user">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <button class="btn btn-info btn-offer text-uppercase">Book Ride</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end signle departure -->

                <!-- single departure -->
                <div class="col-sm-6 col-xs-12 padding-right-o">
                    <div class="get-single-departure clearfix">
                        <div class="col-sm-8 ">
                            <div class="get-user-icon">
                                <img src="{{ asset('public/assets/frontend/img/user/user-1.jpg') }}" alt="">
                            </div>
                            <div class="get-user-details">
                                <h3 class="get-user-name"><span>Name <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">Jonson Martin</span></h3>
                                <h3 class="get-user-name"><span>Age <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">26</span></h3>
                                <h3 class="get-user-name"><span>Seats Available <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name"></span></h3>
                                <ul class="get-user-icon-layer">
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="get-user-ratings">
                                <ul class="get-rate-user">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <button class="btn btn-info btn-offer text-uppercase">Book Ride</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end signle departure -->

                <!-- single departure -->
                <div class="col-sm-6 col-xs-12  padding-left-o">
                    <div class="get-single-departure clearfix">
                        <div class="col-sm-8">
                            <div class="get-user-icon">
                                <img src="{{ asset('public/assets/frontend/img/user/user-1.jpg') }}" alt="">
                            </div>
                            <div class="get-user-details">
                                <h3 class="get-user-name"><span>Name <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">Jonson Martin</span></h3>
                                <h3 class="get-user-name"><span>Age <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">26</span></h3>
                                <h3 class="get-user-name"><span>Seats Available <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name"></span></h3>
                                <ul class="get-user-icon-layer">
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="get-user-ratings">
                                <ul class="get-rate-user">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <button class="btn btn-info btn-offer text-uppercase">Book Ride</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end signle departure -->

                <!-- single departure -->
                <div class="col-sm-6 col-xs-12 padding-right-o">
                    <div class="get-single-departure clearfix">
                        <div class="col-sm-8">
                            <div class="get-user-icon">
                                <img src="{{ asset('public/assets/frontend/img/user/user-1.jpg') }}" alt="">
                            </div>
                            <div class="get-user-details">
                                <h3 class="get-user-name"><span>Name <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">Jonson Martin</span></h3>
                                <h3 class="get-user-name"><span>Age <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name">26</span></h3>
                                <h3 class="get-user-name"><span>Seats Available <span class="get-right-icon">:</span></span>
                                    <span class="get-dynamic-name"></span></h3>
                                <ul class="get-user-icon-layer">
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                    <li><i class="fas fa-user"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="get-user-ratings">
                                <ul class="get-rate-user">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <button class="btn btn-info btn-offer text-uppercase">Book Ride</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end signle departure -->
            </div>
        </div>
    </div>
    <!-- end todays deparature -->

    <!-- about us -->
    <div class="get-about-us clearfix">
        <div class="container">
            <div class="row">
                <h2 class="get-about-us-title">Go Literally <span>anywhere.</span> <br> from <span>everywhere.</span></h2>
                <div class="col-sm-3 padding-left-o">
                    <div class="get-single-text clearfix">
                        <div class="icon"><img class="icon-1" src="{{ asset('public/assets/frontend/img/icon-1.png') }}" alt="icon-1"></div>
                        <h3 class="get-single-title">Smart</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</p>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="get-single-text clearfix">
                        <div class="icon"><img class="icon-2" src="{{ asset('public/assets/frontend/img/icon-2.png') }}" alt="icon-2"></div>
                        <h3 class="get-single-title">Simple</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="get-single-text clearfix">
                        <div class="icon"><img class="icon-3" src="{{ asset('public/assets/frontend/img/icon-3.png') }}" alt="icon-3"></div>
                        <h3 class="get-single-title">Seamless</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about us -->

    @endsection