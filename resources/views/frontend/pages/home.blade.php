@extends('frontend.layout')
@section('content')

    @if(Auth::check() && Auth::user()->role == 'driver')
        <div class="get-offer-ride">
            <div class="container">
                <div class="row">
                    @if(session()->has('error'))
                        <p class="alert alert-danger">
                            {{ session()->get('error') }}
                        </p>
                    @endif
                    <div class="ridemate-offer-button">
                        <a style="color: #ffffff;" href="{{ url('/d/offer-ride') }}"><button class="btn btn-info btn-offer">Offer a ride <i class="fas fa-car"></i></button></a>
                        <a style="color: #ffffff;" href="{{ url('/d/ride-requests') }}"><button class="btn btn-info btn-offer">Requests For Ride</button></a>
                    </div>
                    <!-- Ride details -->
                    <div class="get-ridemate-single">
                        <h3 class="check-total-fare text-center">Requests of Rides</h3>

                    @if(isset($reqs))
                        @foreach($reqs as $req)
                            @if(!isset($req->exx))

                                <!-- single request area -->

                                    <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8  col-lg-offset-2 col-xs-12 ridemate-details-offer padding-left-o">
                                        <h4 class="ridemate-home-h3">Ride Details</h4>
                                        <div class="col-sm-8 col-xs-12 padding-left-o">
                                            <div class="get-car-details-area clearfix">
                                                <div class="col-sm-5">
                                                    <span class="ride-label">Form<span class="right-into">:</span></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="ride-label-badge">{{ $req->from }}</span>
                                                </div>
                                            </div>
                                            <div class="get-car-details-area clearfix">
                                                <div class="col-sm-5">
                                                    <span class="ride-label">To<span class="right-into">:</span></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="ride-label-badge">{{ $req->to }}</span>
                                                </div>
                                            </div>
                                            <div class="get-car-details-area clearfix">
                                                <div class="col-sm-5">
                                                    <span class="ride-label">Requested Seats <span class="right-into">:</span></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="ride-label-badge">{{ $req->required_seat }}</span>
                                                </div>
                                            </div>
                                            <button class="btn btn-info btn-offer ride-final-ride-button" type="button" data-toggle="modal" data-target="#myModalx{{ $req->id }}">Riders Details</button>
                                        </div>
                                        <div class="col-sm-4 col-xs-12 ride-details-feature">
                                            <div class="get-car-details-area clearfix">
                                                <div class="col-sm-5">
                                                    <span class="ride-label">Date <span class="right-into">:</span></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="ride-label-badge">{{ date('Y-m-d H:i A', strtotime($req->departure_date)) }}</span>
                                                </div>
                                            </div>
                                            <button class="btn btn-info btn-offer offer-ride-ridemate-home"><a style="color: purple;" href="{{ url('/d/offer-ride?req='.$req->id) }}">Offer Ride</a></button>
                                        </div>
                                    </div>
                                    <!-- end single ridemate area -->

                                @endif
                            @endforeach
                        @endif
                    </div>
                    <!-- end ridemate details -->
                </div>
            </div>
        </div>
    @else

        <!-- landing area -->
        <div class="get-landing-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        @include('frontend.includes.messages')
                        @if(isset($errors))
                            @foreach($errors as $error)
                                <p class="alert alert-danger">
                                    {{ $error }}
                                </p>
                            @endforeach
                        @endif
                        <div class="get-landing-text">
                            <h2 class="get-section-header where-to-section-it">Where to?</h2>
                            <div class="get-a-ride">
                                <form action="{{ url('/search') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-sm-3 col-xs-12 padding-left-o">
                                        <input type="text" name="from" id="" data-live-search="true" class="get-select-picker placepicker form-control" placeholder="From" required>
                                    </div>
                                    <div class="col-sm-3 col-xs-12 padding-left-o">
                                        <input type="text" name="to" id="" data-live-search="true" class="get-select-picker placepicker form-control" placeholder="To" required>
                                    </div>
                                    <div class="col-sm-2 col-xs-12 padding-left-o">
                                        <input type="text" name="when" class="form-control" id="datetimepicker5" placeholder="When" required>
                                    </div>
                                    <div class="col-sm-2 col-xs-12 padding-left-o">
                                        <select name="seats" class="get-select-picker" title="Seats" required>
                                            <option value="1">1 seats</option>
                                            <option value="2">2 seats</option>
                                            <option value="3">3 seats</option>
                                            <option value="4">4 seats</option>
                                            <option value="5">5 seats</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 col-xs-12 padding-left-o">
                                        <button type="submit" class="btn btn-info btn-offer"><span>Get a ride </span><i class="fas fa-car"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="are-you-driving">
                            <h2 class="get-bold-text">Are you driving <br> somewhere soon?</h2>
                            <p>Take a ride through GetWobo and change the experience of the journey that you never feel before.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end landing area -->



        <!-- todays departure -->
        <div class="get-departure clearfix">
            <div class="container">
                <div class="row">
                    <h2 class="get-departure-title">Today's Departure</h2>
                @if($offers->isNotEmpty())
                    @foreach($offers as $of)
                        @php $books = 0 @endphp
                        @if($of->bookings->isNotEmpty())
                            @foreach($of->bookings as $book)
                                @php $books += $book->seat_booked @endphp
                            @endforeach
                        @endif
                        <!-- single departure -->
                            <div class="col-sm-6 col-xs-12 padding-left-o">
                                <div class="get-single-departure clearfix">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="get-user-icon">
                                            <img src="@if(isset($of->user_data->picture )) {{ asset('public/uploads/drivers/'.$of->user_data->picture) }} @else {{ asset('public/assets/frontend/img/pp.png') }} @endif" alt="">
                                        </div>
                                        <div class="get-user-details">
                                            <h3 class="get-user-name"><span>Name <span class="get-right-icon">:</span></span>
                                                <span class="get-dynamic-name">{{ $of->user_details->name }} {{ $of->user_data->last_name }}</span></h3>
                                            <h3 class="get-user-name"><span>Age <span class="get-right-icon">:</span></span>
                                                <span class="get-dynamic-name">{{ date('Y') - date('Y',strtotime($of->user_data->dob)) }}</span></h3>
                                            <h3 class="get-user-name"><span>From <span class="get-right-icon">:</span></span>
                                                <span class="get-dynamic-name dynamic-options">{{ $of->origin }}</span></h3>
                                            <h3 class="get-user-name"><span>To <span class="get-right-icon">:</span></span>
                                                <span class="get-dynamic-name dynamic-options">{{ $of->destination }}</span></h3>
                                            <h3 class="get-user-name"><span>Seats Available <span class="get-right-icon">:</span></span>
                                                <span class="get-dynamic-name"></span></h3>
                                            <ul class="get-user-icon-layer">
                                                @for($i = 0; $i < ($of->total_seats - $books); $i++)
                                                    <li><i class="fas fa-user"></i></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <h3 class="get-user-name"><span>Departure Time <span class="get-right-icon">:</span></span>
                                            <span class="get-dynamic-name">{{ date('Y-m-d H:i',strtotime($of->departure_time)) }}</span></h3><br/>
                                        <div class="get-user-ratings">
                                            <ul class="get-rate-user">
                                                <?php
                                                    if($of->average > 0 && $of->average < 2){
                                                        echo "<li><i class='fas fa-star'></i></li>";
                                                    }
                                                    elseif($of->average > 1 && $of->average < 3){
                                                        echo "<li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>";
                                                    }elseif($of->average >=3  && $of->average < 4){
                                                        echo "<li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>";
                                                    }elseif($of->average >= 4 && $of->average < 5){
                                                        echo "<li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>";
                                                    }elseif($of->average == 5){
                                                        echo "<li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>
                                                            <li><i class='fas fa-star'></i></li>";
                                                    }else{
                                                        echo '';
                                                    }
                                                ?>
                                            </ul>
                                            <a href="@if(Auth::check() && Auth::user()->role == 'driver') {{ url('/d/ride-details/'.$of->link) }} @elseif(Auth::check() && Auth::user()->role == 'customer') {{ url('/c/ride-details/'.$of->link) }} @else {{ url('/ride-details/'.$of->link) }} @endif"><button class="btn btn-info btn-offer text-uppercase">Book Ride</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end signle departure -->
                        @endforeach
                    @else
                        <h3>There's no departure in your area today.</h3>
                    @endif
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
    @endif

@endsection
