<!--Riders details -->
<div class="modal fade" id="myModalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Riders Details</h4>
            </div>
            <div class="modal-body rider-details-ridemate">
                <h3 class="rider-title">Rider</h3>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Name <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $data->user->name }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Email <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $data->user->email }}</span>
                    </div>
                </div>

                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Gender <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $data->user->gender }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Occupied Seat <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- request to book -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Require Log In</h4>
            </div>
            <div class="modal-body table-responsive">
                <p>Please log in first!!!</p>
            </div>
            <div class="modal-footer login-modal-footer">
                <a href="{{ url('/sign-up/customer') }}"><button class="btn btn-info btn-offer ">Login</button></a>
                <button class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- request to book -->
<div class="modal fade" id="startRide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Require Log In</h4>
            </div>
            <div class="modal-body table-responsive">
                <p>Please log in first!!!</p>
            </div>
            <div class="modal-footer login-modal-footer">
                <form method="post" action="{{ route('ride_details', $data->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success btn-offer" name="start_ride">Yes</button>
                    <button class="btn btn-danger btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


@if(isset($data->bookings))
    @foreach($data->bookings as $b)
<!--Add Riders in Seats details -->
<div class="modal fade" id="myModalnsx{{ $b->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rider Information</h4>
            </div>
            <div class="modal-body rider-details-ridemate">
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Name <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $b->requester->name }} {{ $b->ud->last_name }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Email <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $b->requester->email }}</span>
                    </div>
                </div>

                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Gender <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $b->ud->gender }}</span>
                    </div>
                </div>
                @if(Auth::id() == $b->user_id && $data->status == 'active')
                    <div class="ridemate-name-area">
                        <div class="ridemate-popup">
                            Ride Add/Cancel Information<span class="ridemate-right">:</span>
                        </div>
                    </div>
                    <div class="ridemate-name-area">
                        <form method="post" action="{{ url('/c/cancel-book') }}" id="cancel-book">
                            {{ csrf_field() }}
                            <input type="hidden" name="page_url" value="{{ url()->current() }}">
                            <input type="hidden" name="book_id" value="{{ $b->id }}">
                            <input type="hidden" name="status" value="canceled">
                        </form>
                        <div class="ridemate-popup">
                            <button type="submit" form="cancel-book" class="btn btn-info btn-offer ride-popup-ride-button">Cancel Booking</button>
                            <button class="btn btn-info btn-offer ride-popup-ride-button"  data-dismiss="modal">Close</button>
                        </div>
                    </div>
                @endif
                @if(Auth::check() && Auth::user()->role == 'driver' && $data->status == 'active' && $data->offer_by == Auth::id())
                <div class="ridemate-name-area">
                    <div class="ridemate-popup">
                        Rider Add/Cancel Information<span class="ridemate-right">:</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    @if($b->status != 'confirmed')
                    <form id="confirm-book" method="post" action="{{ url('/d/confirm-bookings') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="book_id" value="{{ $b->id }}">
                        <input type="hidden" name="link" value="{{ $data->link }}">
                        <input type="hidden" name="status" value="confirmed">
                    </form>
                    @endif
                    <form method="post" action="{{ url('/d/cancel-bookings') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="book_id" value="{{ $b->id }}">
                        <input type="hidden" name="link" value="{{ $data->link }}">
                        <input type="hidden" name="status" value="rejected">
                    </form>
                    <div class="ridemate-popup">
                        @if($b->status != 'confirmed')
                        <button type="submit" form="confirm-book" class="btn btn-info btn-offer ride-popup-ride-button">Confirm Booking</button>
                        @endif
                        <button class="btn btn-info btn-offer ride-popup-ride-button"  data-dismiss="modal">Cancel Booking</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
        @endforeach
    @endif

                <!-- request to book -->
<div class="modal fade" id="startRidePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Start the Ride</h4>
            </div>
            <div class="modal-body table-responsive">
                <p>Do you want to start the ride?</p>
            </div>
            <div class="modal-footer login-modal-footer">
                <form method="post" action="{{ url('/d/start-ride') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="ride_id" value="{{ $data->id }}">
                    <input type="hidden" name="start_time" value="{{ date('Y-m-d H:i:s') }}">
                    <input type="hidden" name="ride_url" value="{{ url()->current() }}">
                    <button type="submit" class="btn btn-success btn-offer">Yes</button>
                    <button type="button" class="btn btn-danger btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

        @if(!empty($ride_start))
            <div class="modal fade" id="endRidePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">End the Ride</h4>
                        </div>
                        <div class="modal-body table-responsive">
                            <p>Do you want to end the ride?</p>
                        </div>
                        <div class="modal-footer login-modal-footer">
                            <form method="post" action="{{ url('/d/end-ride') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="ride_id" value="{{ $ride_start->id }}">
                                <input type="hidden" name="end_time" value="{{ date('Y-m-d H:i:s') }}">
                                <input type="hidden" name="ride_url" value="{{ url()->current() }}">
                                <button type="submit" class="btn btn-success btn-offer">Yes</button>
                                <button type="button" class="btn btn-danger btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

@if(Auth::check() && Auth::user()->role == 'customer')
            <!--Add Riders in Seats details -->
            <div class="modal fade" id="book-ride" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Ride Information</h4>
                        </div>
                        <div class="modal-body rider-details-ridemate">
                            <form method="post" action="{{ url('/c/book-ride') }}">
                                {{ csrf_field() }}
                            <div class="ridemate-name-area">
                                <div class="ridemate-name">
                                    Available Seats <span class="ridemate-right">:</span>
                                </div>
                                <div class="ridemate-name-xs">
                                    <span>{{ $data->total_seats - $total_books }}</span>
                                </div>
                            </div>
                            <div class="ridemate-name-area">
                                <div class="ridemate-name">
                                    Required seats <span class="ridemate-right">:</span>
                                </div>
                                <div class="ridemate-name-xs">
                                    <span class="col-xs-4"><input type="number" class="form-control" name="seat_booked" min="1" max="{{ $data->total_seats - $total_books }}" value="1" required=""></span>
                                </div>
                            </div>

                            <div class="ridemate-name-area">
                                <div class="ridemate-popup">
                                    Ride Book/Cancel Information<span class="ridemate-right">:</span>
                                </div>
                            </div>
                            <div class="ridemate-name-area">
                                <div class="ridemate-popup">
                                    <input type="hidden" name="ride_id" value="{{ $data->id }}">
                                    <input type="hidden" name="status" value="booked">
                                    <input type="hidden" name="ride_url" value="{{ url()->current() }}">
                                    <button type="submit" class="btn btn-info btn-offer ride-popup-ride-button">Confirm Booking</button>
                                    <button type="button" class="btn btn-info btn-offer ride-popup-ride-button"  data-dismiss="modal">Cancel Booking</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endif