@extends('frontend.layout')
@section('content')
    <!--ridemate profile -->
    <div class="get-offer-ride  get-ride-mate-profile">
        <div class="container">
            <div class="row">
                <div class="highlight-get-popular clearfix">
                    <div class="col-sm-12 col-md-8 col-xs-12 padding-left-o">
                        <h3 class="get-popular-list">Ridemate Profile</h3>
                        <div class="get-ridemate-user clearfix">
                            <div class="user-icon">
                                <img src="@if(isset($usd->picture)) {{ asset('public/uploads/driver/'.$usd->picture) }} @endif" alt="">
                            </div>
                            <div class="user-details">
                                <h3 class="get-ride-user">{{ $user->name }}</h3>
                                <div class="user-get-emails">
                                    <ul>
                                        <li><p>Email<span class="ride-button">:</span></p>
                                            <span>{{ $user->email }}</span>
                                        </li>
                                        <li><p>Age<span class="ride-button">:</span></p>
                                            <span>{{ date('Y') - date('Y',strtotime($usd->dob)) }}</span>
                                        </li>
                                        <li><p>Gender<span class="ride-button">:</span></p>
                                            <span>{{ $usd->gender }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="get-available-seats ridemate-profile--w clearfix">
                    <h3 class="check-total-fare">Ride Description</h3>
                    <div class="col-sm-5 col-xs-12 padding-left-o">
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-6 padding-left-o">
                                <span class="ride-label">Car Type <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $vd->car_type }}</span>
                            </div>
                        </div>
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-6 padding-left-o">
                                <span class="ride-label">Car Plate No <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $vd->car_plate_no }}</span>
                            </div>
                        </div>
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-6 padding-left-o">
                                <span class="ride-label">Maximum Luggage <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $vd->luggage_limit }}</span>
                            </div>
                        </div>
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-6 padding-left-o">
                                <span class="ride-label">Language Proficiency <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $vd->language }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Ride description  -->
                <!-- feedback -->
                <div class="get-feedback-area ridemate-profile--w clearfix">
                <h3 class="check-total-fare clearfix">Feedbacks</h3>
                @foreach($ratings as $rat)
                    <div class="user-feedback-section clearfix">
                        <div class="feedback-user-icon"><img src="@if(isset($rat->img)){{ asset('/public/uploads/customers/'.$rat->img) }}@else {{ asset('public/assets/frontend/img/pp.png') }} @endif" alt=""></div>
                        <div class="feedback-get-user">
                            <h3 class="user-name">{{ $rat->name }}</h3>
                            <ul class="get-user-icon-layer clearfix">
                                @for($i = 1; $i <= $rat->rating;$i++)
                                    <li><i class="fas fa-star"></i></li>
                                @endfor
                            </ul>
                            <p>{{ $rat->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>
    <!-- end ridemate profile area  -->

@endsection