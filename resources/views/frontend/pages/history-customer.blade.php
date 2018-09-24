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
                    <h3 class="check-total-fare text-center">Rides History</h3>
                    <!-- single request area -->
                    @foreach($data as $d)
                        @if($d->check == 'yes')
                    <div class="col-md-8 col-md-offset-2  col-sm-12 col-xs-12 ridemate-details-offer padding-left-o">
                        <h4 class="ridemate-home-h3">Ride Details</h4>

                        <div class="col-sm-8 col-xs-12 padding-left-o">
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">Form<span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ $d->origin }}</span>
                                </div>
                            </div>
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">To<span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ $d->destination }}</span>
                                </div>
                            </div>
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">Requested Seats <span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ $d->seat_booked }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 ride-details-feature">
                            <div class="get-car-details-area clearfix">
                                <div class="col-sm-5">
                                    <span class="ride-label">Date <span class="right-into">:</span></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="ride-label-badge">{{ date('d-m-Y',strtotime($d->arrival_time)) }}</span>
                                    <span class="ride-label-badge">{{ date('H:i A',strtotime($d->arrival_time)) }}</span>
                                </div>
                            </div>
                            <a href="{{ url('/ride-details/'.$d->link) }}"><button class="btn btn-info btn-offer text-uppercase">Ride Details</button></a>
                        </div>
                    </div>
                        @endif
                    @endforeach
                    <!-- end single ridemate area -->


                </div>
                <!-- end ridemate details -->
                <div class="col-xs-12 col-lg-12">
                    <div class="getwobo-pagination">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{ $data->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection