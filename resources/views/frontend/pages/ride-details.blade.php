@extends('frontend.layout')
@section('content')
    <?php $total_books = 0 ?>
    @foreach($data->bookings as $books)
        <?php $total_books += $books->seat_booked; ?>
    @endforeach
    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                <h3 class="get-popular-list list-option-ride">Ride Details</h3>
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

                @if(Auth::check() && Auth::user()->role == 'driver' && Auth::id() == $data->offer_by)
                    @if(empty($ride_start))
                    @if(date('Y-m-d H:i', strtotime($data->departure_time)) <= date('Y-m-d H:i', strtotime('+1 Hour')) && date('Y-m-d H:i', strtotime($data->departure_time)) >= date('Y-m-d H:i'))
                <div class="get-form-control-button">
                    <button type="button" class="btn btn-info btn-offer" data-toggle="modal" data-target="#startRidePop">Start the Ride</button>
                </div>
                        @endif
                        @else
                        @if(!isset($ride_start->end_time))
                        <div class="get-form-control-button">
                            <p class="alert alert-success">Your ride was started. Please click to end the ride.</p>
                            <button type="button" class="btn btn-info btn-offer" data-toggle="modal" data-target="#endRidePop">End the Ride</button>
                        </div>
                            @endif
                        @endif
                @endif
                <div class="col-sm-12 get-join-as">
                    <div class="col-sm-5">
                        <div class="form-ride-details">
                            <h3>Form</h3>
                            <h2 id="start">{{ $data->origin }}</h2>
                            <p></p>
                            <p class="get-departure-time">Departure Time: <span class="get-time">{{ date('Y-m-d H:i A', strtotime($data->departure_time)) }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="arrow-icon">
                            <img src="{{ asset('public/assets/frontend/img/arrow-icon.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-ride-details">
                            <h3>To</h3>
                            <h2 id="end">{{ $data->destination }}</h2>
                            <p></p>
                            <p class="get-departure-time">Arraival Time: <span class="get-time">{{ date('Y-m-d H:i A', strtotime($data->arrival_time)) }}</span></p>
                        </div>
                    </div>
                </div>
                <!--End rdemade details  -->
                <!-- available seats -->
                <div class="get-available-seats get-normal-seats clearfix">
                    <div class="col-sm-4 padding-left-o">
                        <h3 class="check-total-fare">Available Seats</h3>
                    </div>
                    <div class="col-sm-5 col-sm-offset-3 col-xs-12">
                        <h3 class="price-per-seats">Price Per Seat: <span>${{ $data->price_per_seat }}</span></h3>
                    </div>
                    <ul class="get-ride-seat clearfix">
                        <li>
                            <div class="ride-seat-icon">
                                <i class="fas fa-user-times fixed-hover"></i>
                                <span>Ridermate</span>
                            </div>
                        </li>
                        <?php $total = 1; ?>
                            @if(isset($data->bookings))
                                @foreach($data->bookings as $book)
                                    @if($book->status == 'booked')
                                    @for($j = 1; $j <= $book->seat_booked; $j++)
                                        <li>
                                            <div class="ride-seat-icon first-ride">
                                                <i class="fas fa-user fixed-hover" data-toggle="modal" data-target="#myModalnsx{{ $book->id }}"></i>
                                                <span>Booked</span>
                                            </div>
                                        </li>
                                        <?php $total++; ?>
                                    @endfor
                                    @elseif($book->status == 'confirmed')
                                    @for($k = 1; $k <= $book->seat_booked; $k++)
                                        <li>
                                            <div class="ride-seat-icon first-ride">
                                                <i class="fas fa-user fixed-hover" data-toggle="modal" data-target="#myModalnsx{{ $book->id }}"></i>
                                                <span>Confirmed</span>
                                            </div>
                                        </li>
                                        <?php $total++; ?>
                                    @endfor
                                    @else
                                        {{ '' }}
                                    @endif
                                @endforeach
                            @endif
                        @for($i = $total; $i <= $data->total_seats; $i++)
                            <li>
                                <div class="ride-seat-icon first-ride">
                                    <i class="fas fa-user"></i>
                                    <span>Empty</span>
                                </div>
                            </li>
                        @endfor
                    </ul>
                    @if(Auth::check() && Auth::user()->role != 'driver')
                    <span class="text-right">*Click To Select Your Seat</span>
                    @endif
                    <div class="col-sm-4 padding-left-o">
                        <h3 class="price-per-seats get-total-fare">Total Fare: <span>${{ $data->price_per_seat*$total_books }}</span></h3>
                    </div>
                    @if(Auth::check())
                        @if(Auth::user()->role == 'customer')
                            @if($total_books != $data->total_seats)
                                <div class="col-sm-5 col-sm-offset-3 col-xs-12">
                                    <button class="btn btn-info btn-offer" data-toggle="modal" data-target="#book-ride">Request To Book</button>
                                </div>
                                @endif
                        @endif
                    @else
                        <div class="col-sm-5 col-sm-offset-3 col-xs-12">
                            <button class="btn btn-info btn-offer" data-toggle="modal" data-target="#myModal2">Request To Book</button>
                        </div>
                    @endif
                </div>
                <!-- end available seats -->

                <!-- get direction -->
                <div class="get-check-direction clearfix">
                    <h3 class="check-direction-title">Check Direction</h3>
                    <div id="googleMap"></div>
                </div>
                <!-- end get direction -->

                <!-- car details -->
                <div class="get-available-seats">
                    <h3 class="check-total-fare">Car Details</h3>
                    <div class="col-sm-5 col-xs-12 padding-left-o">
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-6 padding-left-o">
                                <span class="ride-label">Car Type <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $data->vd->car_type }}</span>
                            </div>
                        </div>
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-6 padding-left-o">
                                <span class="ride-label">Car Plate No <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $data->vd->car_plate_no }}</span>
                            </div>
                        </div>
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-6 padding-left-o">
                                <span class="ride-label">Maximum Luggage <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $data->vd->luggage_limit }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-3 col-xs-12 ride-details-feature">
                        <ul class="get-ride-feature">
                            <li>
                                <span class="right-ride-feature @foreach($data->rd as $r)@if($r->key == 'pets')@if( $r->value == 'yes'){{"icon-feature-details"}}@else{{"icon-cross-details"}}@endif @endif @endforeach"></span>
                                <span class="left-ride-feature">Pets</span>
                            </li>
                            <li>
                                <span class="right-ride-feature @foreach($data->rd as $r)@if($r->key == 'music')@if( $r->value == 'yes'){{"icon-feature-details"}}@else{{"icon-cross-details"}}@endif @endif @endforeach"></span>
                                <span class="left-ride-feature">Music</span>
                            </li>
                            <li>
                                <span class="right-ride-feature @foreach($data->rd as $r)@if($r->key == 'smoking')@if( $r->value == 'yes'){{"icon-feature-details"}}@else{{"icon-cross-details"}}@endif @endif @endforeach"></span>
                                <span class="left-ride-feature">Smoking</span>
                            </li>
                            <li>
                                <span class="right-ride-feature @foreach($data->rd as $r)@if($r->key == 'back_seat')@if( $r->value == 'yes'){{"icon-feature-details"}}@else{{"icon-cross-details"}}@endif @endif @endforeach"></span>
                                <span class="left-ride-feature">Max.2 in back Seat</span>
                            </li>
                            @foreach($data->rd as $r)
                                @if(!in_array($r->key, ['vehicle_id', 'pets', 'music', 'smoking', 'back_seat']))
                                    <li>
                                        <span class="right-ride-feature @if( $r->value == 'yes'){{"icon-feature-details"}}@else{{"icon-cross-details"}}@endif"></span>
                                        <span class="left-ride-feature">{{ $r->key }}</span>
                                    </li>
                                    @endif
                                @endforeach
                        </ul>
                    </div>
                    @if(Auth::check() && Auth::user()->role != 'driver')
                    <button class="btn btn-info btn-offer ride-final-ride-button" type="button" data-toggle="modal" data-target="#myModalx">Ridemate Details</button>
                        @endif
                    @if(Auth::check() && Auth::user()->role == 'driver' && !isset($ride_start->start_time) && Auth::id() == $data->offer_by)
                        <button class="btn btn-info btn-offer ride-final-ride-button" type="button"><a style="color: #ffffff" href="{{ url('/d/edit-ride/'.$data->link) }}">Edit Ride Details</a></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end offer a ride -->
    @endsection

