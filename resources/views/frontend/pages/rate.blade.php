@extends('frontend.layout')
@section('content')
    <!--ridemate rating -->
    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-10 col-xs-12 col-xs-offset-0 padding-right-0">
                    <div class="get-offer-button">
                        <button class="btn btn-info btn-offer" data-toggle="modal" data-target="#myModalx2">Find a ride <i class="fas fa-car"></i></button>
                    </div>
                </div>
                <div class="col-sm-6">
                    @include('frontend.includes.messages')
                    @if(isset($errors))
                        @foreach($errors as $error)
                            <p class="alert alert-danger">
                                {{ $error }}
                            </p>
                        @endforeach
                    @endif
                </div>
                <div class="highlight-get-popular clearfix">
                    <div class="col-sm-8 col-xs-12 padding-left-o">
                        <h3 class="get-popular-list">Rate</h3>
                        <h3 class="highlight">The Ridemate</h3>
                        <div class="get-ridemate-user clearfix">
                            <div class="user-icon">
                                <img src="@if(isset($data->driver_data->picture)){{ asset('/public/uploads/drivers/'.$data->driver_data->picture) }} @else {{ asset('public/assets/frontend/img/pp.png') }} @endif" alt="">
                            </div>
                            <div class="user-details">
                                <h3 class="get-ride-user">{{ $data->driver->name }} {{ $data->driver_data->last_name }}</h3>
                                <div class="user-get-emails">
                                    <ul>
                                        <li><p>Email<span class="ride-button">:</span></p>
                                            <span>{{ $data->driver->email }}</span>
                                        </li>
                                        <li><p>Age<span class="ride-button">:</span></p>
                                            <span>{{ date_diff(date_create($data->driver_data->dob), date_create('today'))->y }}</span>
                                        </li>
                                        <li><p>Gender<span class="ride-button">:</span></p>
                                            <span>{{ $data->driver_data->gender }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ url('/c/rate/'.$data->link) }}">
                    {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="ride-performance text-center">
                        <p>You have experienced the ride,<span> Now lets rate the ridemate’s performance!</span></p>
                        <ul class="performance-rating">
                            <li>
										<span class="click-performance">
											<i class="fas fa-star fa-2x" rel="1" id="rate-1"></i><br>
											Bad
										</span>
                            </li>
                            <li>
										<span class="click-performance">
											<i class="fas fa-star fa-2x" rel="2" id="rate-2"></i><br>
											Unsatisfying
										</span>
                            </li>
                            <li>
										<span class="click-performance">
											<i class="fas fa-star fa-2x" rel="3" id="rate-3"></i><br>
											Average
										</span>
                            </li>
                            <li>
										<span class="click-performance">
											<i class="fas fa-star fa-2x" rel="4" id="rate-4"></i><br>
											Good
										</span>
                            </li>
                            <li>
										<span class="click-performance">
											<i class="fas fa-star fa-2x" rel="5" id="rate-5"></i><br>
											Excellent
										</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="leave-a-feedback">
                        <h3 class="check-direction-title">Leave a Feedback</h3>
                        <textarea name="comment" id="" cols="30" rows="8" placeholder="Leave your valuable feedback" class="form-control"></textarea>
                        <input type="hidden" name="rating" id="rating">
                        <input type="hidden" name="from" value="{{ Auth::id() }}">
                        <input type="hidden" name="to" value="{{ $data->driver->id }}">
                        <input type="hidden" name="ride_id" value="{{ $data->id }}">
                        <button type="submit" class="btn btn-info btn-offer pull-right">Send</button>
                    </div>
                </div>
                </form>
                <!--End rdemade rating  -->

            </div>
        </div>
    </div>
    <!-- end offer a ride -->
    @endsection