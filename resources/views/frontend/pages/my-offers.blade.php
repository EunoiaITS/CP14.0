@extends('frontend.layout')
@section('content')

    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                <div class="ridemate-offer-button">
                    <form action="#">
                        <div class="col-sm-2 col-sm-offset-2">
                            <label for="search-ride">Search <span class="right-info-right">:</span></label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Ex:Location , Riders name" class="form-control">
                        </div>
                    </form>
                </div>
                <!-- Ride details -->
                <div class="get-ridemate-single">
                    <h3 class="check-total-fare text-center">Upcoming Rides</h3>

                    @foreach($data as $offer)

                        <?php $total = $booked = $confirmed = 0; ?>
                                @if($offer->bookings->isNotEmpty())
                                    @foreach($offer->bookings as $bb)
                                        <?php $total += $bb->seat_booked; ?>
                                        @if($bb->status == 'booked')
                                            <?php $booked += $bb->seat_booked; ?>
                                            @endif
                                        @endforeach
                                    @endif
                    <!-- single request area -->

                    <div class="col-md-8 col-md-offset-2  col-sm-12 col-xs-12 ridemate-details-offer padding-left-o">
                        <h4 class="ridemate-home-h3">Ride Details</h4>
                        <div class="col-sm-8 col-xs-12 padding-left-o">
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">Form<span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ $offer->origin }}</span>
                                </div>
                            </div>
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">To<span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ $offer->destination }}</span>
                                </div>
                            </div>
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">Requested Seats <span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ $booked }}</span>
                                </div>
                            </div>
                            <button class="btn btn-info btn-offer ride-final-ride-button" type="button"><a style="color: #ffffff" href="{{ url('/d/ride-details/'.$offer->link) }}">Ride Details</a></button>
                        </div>
                        <div class="col-sm-4 col-xs-12 ride-details-feature">
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">Date <span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ date('d-m-Y H:i A',strtotime($offer->departure_time)) }}</span>
                                </div>
                            </div>
                            <button class="btn btn-info btn-offer offer-ride-ridemate-home"><a style="color: purple" href="{{ url('/d/edit-ride/'.$offer->link) }}">Edit Ride</a></button>
                        </div>
                    </div>
                    <!-- end single ridemate area -->
                    @endforeach


                </div>
                <!-- end ridemate details -->
            </div>
        </div>
    </div>

    @endsection