@extends('frontend.layout')
@section('content')
<div class="get-offer-ride">
    <div class="container">
        <div class="row">
            <div class="ridemate-offer-button">
                <form action="{{ url('/d/ride-requests') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-sm-2 col-sm-offset-2">
                        <label for="search-ride">Search <span class="right-info-right">:</span></label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="search" placeholder="Ex: Location" class="form-control">
                    </div>
                </form>
            </div>
            <!-- Ride details -->
            <div class="get-ridemate-single">
                <h3 class="check-total-fare text-center">Requests of Rides</h3>
                @if(isset($rrc))
                    <div class="col-md-8 col-md-offset-2  col-sm-12 col-xs-12">
                        <h4 class="text-center alert alert-success">{{ $rrc . ' Search Results Found !' }}</h4>
                    </div>
                @endif
                <!-- single request area -->
                @foreach($data as $d)
                <div class="col-md-8 col-md-offset-2  col-sm-12 col-xs-12 ridemate-details-offer padding-left-o">
                    <h4 class="ridemate-home-h3">Ride Details</h4>
                    <div class="col-sm-8 col-xs-12 padding-left-o">
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-5">
                                <span class="ride-label">Form<span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $d->from }}</span>
                            </div>
                        </div>
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-5">
                                <span class="ride-label">To<span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $d->to }}</span>
                            </div>
                        </div>
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-5">
                                <span class="ride-label">Requested Seats <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ $d->seat_required }}</span>
                            </div>
                        </div>
                        <button class="btn btn-info btn-offer ride-final-ride-button" type="button" data-toggle="modal" data-target="#myModalx{{$d->id}}">Riders Details</button>
                    </div>
                    <div class="col-sm-4 col-xs-12 ride-details-feature">
                        <div class="get-car-details-area clearfix">
                            <div class="col-sm-5">
                                <span class="ride-label">Date <span class="right-into">:</span></span>
                            </div>
                            <div class="col-sm-6">
                                <span class="ride-label-badge">{{ date('d-m-Y',strtotime($d->departure_date)) }}</span>
                            </div>
                        </div>
                        <a href="{{ url('/d/offer-ride?req='.$d->id) }}"><button class="btn btn-info btn-offer offer-ride-ridemate-home">Offer Ride</button></a>
                    </div>
                </div>
                @endforeach
                <!-- end single ridemate area -->
            </div>
            <!-- end ridemate details -->
            <div class="col-xs-12 col-lg-12">
                <div class="getwobo-pagination">
                    <nav aria-label="Page navigation">
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Ridemate details -->
@foreach($data as $d)
<div class="modal fade" id="myModalx{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rider's Details</h4>
            </div>
            <div class="modal-body">
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Name <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $d->user->name }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Email <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{  $d->user->email }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Age <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ (date('Y') - date('Y',strtotime($d->usd->dob))) }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Gender <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $d->usd->gender }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection