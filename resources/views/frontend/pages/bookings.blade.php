@extends('frontend.layout')
@section('content')

    <!--ridemate profile -->
    <div class="get-offer-ride  get-ride-mate-profile">
        <div class="container">
            <div class="row">
                <div class="price-seat">

                    <div class="my-bookings-area clearfix">
                        <h3 class="get-popular-list">My Bookings</h3>
                        <div class="col-sm-12 clearfix">
                            @include('frontend.includes.messages')
                            @if(isset($errors))
                                @foreach($errors as $error)
                                    <p class="alert alert-danger">
                                        {{ $error }}
                                    </p>
                                @endforeach
                            @endif
                        </div>
                        @foreach($data as $book)
                            @if($book->ride_details->status == 'active')
                        <!-- single ride area -->
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-left-o">
                            <div class="single-booking-point">
                                <div class="col-sm-5 padding-left-o">
                                    <div class="departure-to-arrival clearfix">
                                        <div class="arrival-line">
                                            <span class="my-location"></span>
                                            <span class="arrival-lin-get"></span>
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <div class="get-area-details">
                                            <div class="get-ride-departure-time">
                                                <h3 class="departure-ride">{{ $book->ride_details->origin }}</h3>
                                                <h4 class="depature-time-get">Departure time: <span>{{ $book->ride_details->departure_time }}</span></h4>
                                            </div>
                                            <div class="get-ride-departure-time">
                                                <h3 class="departure-ride">{{ $book->ride_details->destination }}</h3>
                                                <h4 class="depature-time-get">Arrival time: <span>{{ $book->ride_details->arrival_time }}</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ridemade-details-button">
                                        <button class="btn btn-info btn-offer" data-toggle="modal" data-target="#myModalRD{{ $book->id }}">Ridemates Details</button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="total-fare-area">
                                        <h3 class="total-fare-get-section">
                                            Total Fare <span>{{ $book->ride_details->price_per_seat }}{{ ' ' }}{{ $book->ride_details->currency }}</span>
                                        </h3>
                                        <h3 class="total-fare-get-section">
                                            Status : <span>@if($book->status == 'booked') <i class="fa fa-exclamation-circle"></i> @elseif($book->status == 'confirmed') <i class="fa fa-check-circle"></i> @else {{ 'None' }} @endif</span>
                                        </h3>
                                        <a href="{{ url('/c/ride-details/'.$book->ride_details->link) }}"><button class="btn btn-info btn-offer"><i class="fas fa-location-arrow"></i> <br> View <br> Details</button></a>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="car-details-type-arrow">
                                        <h3>Car Details</h3>
                                        <ul>
                                            <li><span class="ride-label">Car Type <span class="right-into">: {{ $book->vd->car_type }}</span></span>
                                            </li>
                                            <li>
                                                <span class="ride-label">Car Plate No <span class="right-into">: {{ $book->vd->car_plate_no }}</span></span>
                                            </li>
                                            <li>
                                                <span class="ride-label">Maximum Luggage <span class="right-into">: {{ $book->vd->luggage_limit }}</span></span>
                                            </li>
                                        </ul>
                                        <button class="btn btn-info btn-offer" type="button" data-toggle="modal" data-target="#myModalCancel{{ $book->id }}">Cancel Booking</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end ridemate profile area  -->

    @endsection