@extends('frontend.layout')
@section('content')
    <div class="get-offer-ride  get-ride-mate-profile">
    <div class="container">
        <div class="row">
            <div class="price-seat">
                <div class="col-lg-12 col-sm-12">
                    <button class="btn btn-info btn-offer edit-badge-area">Edit Info <img src="{{ url('/') }}/public/assets/frontend/img/file.png" alt=""></button>
                    <!-- notification popupbar -->
                    <div class="get-edit-profile">
                        <ul class="edit-profile-option">
                            <li><a href="{{ url('c/profile/edit/'.$user->id) }}">Edit Profile</a></li>
                            <li data-toggle="modal" data-target="#myModal">Credit Card Information</li>
                            <li data-toggle="modal" data-target="#myModalx">Change Password</li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
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
                <div class="col-md-9 col-lg-8 col-sm-12 col-xs-12 ride--profile padding-left-o">
                    <form action="#">
                        <h3 class="get-popular-list">Riders Profile</h3>
                        <div class="get-ridemate-user ">
                            <div class="user-icon">
                                <img src=" @if(isset($usd->picture)){{ asset('public/uploads/customers/'.$usd->picture) }} @else {{ asset('public/assets/frontend/img/pp.png') }}  @endif" alt="">
                            </div>
                            <div class="user-details">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="name" class="user-get-label">Name</label>
                                    </div>
                                    <div class="col-sm-9 col-xs-12">
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <p class="col-sm-3">
                                        <label for="email" class="user-get-label">Email</label>
                                    </p>
                                    <div class="col-sm-9">
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-3">
                                        <label for="age" class="user-get-label">Age</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <p>{{ date('Y') - date('Y',strtotime($usd->dob)) }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="age" class="user-get-label">Gender</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>{{ $usd->gender }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="clearfix"></div>

                <div class="my-bookings-area clearfix">
                    <h3 class="get-popular-list">My Bookings</h3>
                    @foreach($data as $book)
                        @if($book->ride_details->status == 'active')
                            <!-- single ride area -->
                            <div class="col-md-12 col-lg-8 col-sm-12 col-xs-12 padding-left-o">
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
                                                Total Fare <span>${{ $book->ride_details->price_per_seat }}</span>
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
</div>
<!-- Credit card information -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Credit Card Information</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 padding-left-o padding-right-0">
                    <div class="form-group">
                        <label for="credit name">Credit Card Holder</label>
                        <input type="text" class="form-control" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="credit name">Credit Card Number</label>
                        <input type="number" class="form-control" placeholder="Credit Card Number">
                    </div>
                    <div class="form-group modal-card-status">
                        <label for="credit name">Credit Card Type</label>
                        <select name="" id="" class="get-select-picker" title="Card">
                            <option value="master-card">Master Card</option>
                            <option value="vis">Visa</option>
                            <option value="paypal">Paypal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="credit name">Activate Credit Card Payment</label>
                        <label class="toggle-switch-box switch-rounded switch-bg-success">
                            <input type="checkbox">
                            <span class="toggle-switch-item" data-tg-on="on" data-tg-off="off">
					    <span class="switch-button"></span>
					  </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer login-modal-footer">
                <div class="modal-footer login-modal-footer">
                    <button type="submit" class="btn btn-info btn-offer">Confirm</button>
                    <button type="button" class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end credit card payment popup -->

<!--change password -->

<div class="modal fade" id="myModalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <form action="{{ url('c/profile/edit/password/'.$user->id) }}" method="post">
                {{csrf_field()}}
            <div class="modal-body">
                <div class="col-sm-12 padding-left-o padding-right-0">
                    <div class="form-group">
                        <input type="password" name="oldpass" class="form-control" placeholder="Old Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="newpass" class="form-control" placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="repass" class="form-control" placeholder="Confirm Password" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer login-modal-footer">
                <button type="submit" class="btn btn-info btn-offer">Confirm</button>
                <button type="button" class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end change password popup -->

<!-- cancel booking popup -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cancel Booking</h4>
            </div>
            <div class="modal-body table-responsive">
                <p>Are you sure you want to cancel your booking ?</p>
            </div>
            <div class="modal-footer login-modal-footer">
                <button type="submit" class="btn btn-info btn-offer">Confirm</button>
                <button type="button" class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- end cancel booking popup -->
@endsection