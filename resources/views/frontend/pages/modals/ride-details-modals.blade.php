<!--Ridemate details -->
<div class="modal fade" id="myModalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ridemate Details</h4>
            </div>
            <div class="modal-body">
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
                        Phone <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $data->usd->contact }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Gender <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $data->usd->gender }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Rating<span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <ul class="get-user-icon-layer">
                            <?php
                            if($data->average > 0 && $data->average < 2){
                                echo "<li><i class='fas fa-star'></i></li>";
                            }
                            elseif($data->average > 1 && $data->average < 3){
                                echo "<li><i class='fas fa-star'></i></li>
                                        <li><i class='fas fa-star'></i></li>";
                            }elseif($data->average >=3  && $data->average < 4){
                                echo "<li><i class='fas fa-star'></i></li>
                                        <li><i class='fas fa-star'></i></li>
                                          <li><i class='fas fa-star'></i></li>";
                            }elseif($data->average >= 4 && $data->average < 5){
                                echo "<li><i class='fas fa-star'></i></li>
                                        <li><i class='fas fa-star'></i></li>
                                          <li><i class='fas fa-star'></i></li>
                                             <li><i class='fas fa-star'></i></li>";
                            }elseif($data->average == 5){
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
                    </div>
                    <div class="ridemate-name-area">
                        <div class="ridemate-name-xs">
                            <span><a href="{{ url('/profile/ridemate?email='.$data->user->email) }}">Details</a></span>
                        </div>
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
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Contact <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $b->ud->contact }}</span>
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
                    <form id="cancel-booking" method="post" action="{{ url('/d/cancel-bookings') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="book_id" value="{{ $b->id }}">
                        <input type="hidden" name="link" value="{{ $data->link }}">
                        <input type="hidden" name="status" value="rejected">
                    </form>
                    <div class="ridemate-popup">
                        @if($b->status != 'confirmed')
                        <button type="submit" form="confirm-book" class="btn btn-info btn-offer ride-popup-ride-button">Confirm Booking</button>
                        @endif
                        <button class="btn btn-info btn-offer ride-popup-ride-button" form="cancel-booking">Cancel Booking</button>
                    </div>
                </div>
                @endif
                @if(Auth::check() && Auth::user()->role == 'driver' && $data->status == 'completed' && $data->offer_by == Auth::id() && !in_array($b->user_id, $rate_tos))
                    <form method="post" action="{{ url('/d/rate/'.$data->link) }}">
                        {{ csrf_field() }}
                    <div class="ride-performance performance-ride text-center">
                        <p>You have experienced the ride,<span> Now lets rate the ridemate’s performance!</span></p>
                        <ul class="performance-rating">
                            <li>
							<span class="click-performance">
								<i class="fas fa-star fa-2x" rel="1" id="rate-1{{ $b->id }}" data-no="{{ $b->id }}"></i><br>
								Bad
							</span>
                            </li>
                            <li>
							<span class="click-performance">
								<i class="fas fa-star fa-2x" rel="2" id="rate-2{{ $b->id }}" data-no="{{ $b->id }}"></i><br>
								Unsatisfying
							</span>
                            </li>
                            <li>
							<span class="click-performance">
								<i class="fas fa-star fa-2x" rel="3" id="rate-3{{ $b->id }}" data-no="{{ $b->id }}"></i><br>
								Average
							</span>
                            </li>
                            <li>
							<span class="click-performance">
								<i class="fas fa-star fa-2x" rel="4" id="rate-4{{ $b->id }}" data-no="{{ $b->id }}"></i><br>
								Good
							</span>
                            </li>
                            <li>
							<span class="click-performance">
								<i class="fas fa-star fa-2x" rel="5" id="rate-5{{ $b->id }}" data-no="{{ $b->id }}"></i><br>
								Excellent
							</span>
                            </li>
                        </ul>
                    </div>
                    <div class="leave-a-feedback feedback-ride-ridemate clearfix">
                        <h4 class="modal-title" id="myModalLabel">Leave a Feedback</h4>
                        <textarea name="" id="" cols="30" rows="6" placeholder="Leave your valuable feedback" class="form-control"></textarea>
                        <input type="hidden" name="rating" id="rating{{ $b->id }}">
                        <input type="hidden" name="from" value="{{ Auth::id() }}">
                        <input type="hidden" name="to" value="{{ $b->user_id }}">
                        <input type="hidden" name="ride_id" value="{{ $data->id }}">
                        <button type="submit" class="btn btn-info btn-offer pull-right">Send</button>
                    </div>
                    <form>
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
                                    <span class="col-xs-4"><input type="number" id="req-seats" class="form-control" name="seat_booked" min="1" max="{{ $data->total_seats - $total_books }}" required=""></span>
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