@extends('frontend.layout')
@section('content')

    <!-- offer a ride -->
    <form method="post" action="{{ url('/d/edit-ride/'.$data->link) }}">
        {{ csrf_field() }}
        <div class="get-offer-ride">
            <div class="container">
                <div class="row">
                    <h3 class="get-ride-title">Offer a Ride (Edit Details)</h3>
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
                    <div class="clearfix"></div>
                    <div class="get-form-offer">
                        <div class="col-sm-6 padding-left-o price-seat">
                            <div class="form-group">
                                <label for="pickup-point">Pickup Point</label>
                                <input name="origin" type="text" id="origin-input" class="form-control" value="{{ $data->origin }}" @if($data->bookings->isNotEmpty()) readonly @endif>
                            </div>
                            <div class="form-group">
                                <label for="pickup-point">Destination</label>
                                <input name="destination" type="text" id="destination-input" class="form-control" value="{{ $data->destination }}" @if($data->bookings->isNotEmpty()) readonly @endif>
                            </div>
                            <div class="col-sm-4 padding-left-o">
                                <div class="form-group">
                                    <label for="price">Price Per seat</label>
                                    <input name="price_per_seat" type="text" placeholder="$200" class="form-control form-control-placeholder" value="{{ $data->price_per_seat }}" @if($data->bookings->isNotEmpty()) readonly @endif>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="price">Currency</label>
                                    <select name="currency" class="form-control form-control-placeholder" required="required" value="{{ old('currency') }}">
                                        <option @if(isset($data))@if($data->currency == 'USD'){{ 'selected' }}@endif @endif>USD</option>
                                        <option @if(isset($data))@if($data->currency == 'BDT'){{ 'selected' }}@endif @endif>BDT</option>
                                        <option @if(isset($data))@if($data->currency == 'RM'){{ 'selected' }}@endif @endif>RM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="number-of-seat">Number Of Seats</label>
                                    <select name="total_seats" id="" class="get-select-picker" title="Seats">
                                        <option value="1" @if(isset($data->total_seats)) @if($data->total_seats == 1) {{ 'selected' }} @endif @endif>1 Seat</option>
                                        <option value="2" @if(isset($data->total_seats)) @if($data->total_seats == 2) {{ 'selected' }} @endif @endif>2 Seats</option>
                                        <option value="3" @if(isset($data->total_seats)) @if($data->total_seats == 3) {{ 'selected' }} @endif @endif>3 Seats</option>
                                        <option value="4" @if(isset($data->total_seats)) @if($data->total_seats == 4) {{ 'selected' }} @endif @endif>4 Seats</option>
                                        <option value="5" @if(isset($data->total_seats)) @if($data->total_seats == 5) {{ 'selected' }} @endif @endif>5 Seats</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 pick--get-atime">
                            <div class="form-group ">
                                <label for="departure-time">Departure Time</label>
                                <div class="padding-left-o">
                                    <input name="d_date" type="text" class="form-control" id="edit-dep" placeholder="Pick a Date" value="{{ date('m/d/Y H:i A', strtotime($data->departure_time)) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="departure-time">Arrival Time(Optional)</label>
                                <div class="padding-left-o">
                                    <input name="a_date" type="text" class="form-control" id="edit-arr" placeholder="Pick a Date" value="{{ date('m/d/Y H:i A', strtotime($data->arrival_time)) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- check direction -->
                    <div class="get-check-direction clearfix">
                        <h3 class="check-direction-title">Check Direction</h3>
                        <div id="googleMap"></div>
                    </div>
                    <!-- end check direction -->

                    <!-- ride description -->
                    <div class="get-ride-description clearfix">
                        <h3 class="check-direction-title">Ride description</h3>
                        <div class="col-sm-12 col-md-6 text-uppercase ride-own-car padding-left-o">
                            <div class="form-group clearfix">
                                <div class="col-sm-6 padding-left-o">
                                    <p>Ride Your Own Car</p>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <ul class="ride-select-option">
                                        <li><input class="check-input" type="checkbox" id="checkbox1" name="checkbox01">
                                            <label class="green-color @if(isset($data->vd)) add-green-color @endif" id="own-vehicle-green" for="checkbox1"></label>
                                        </li>
                                        <li>
                                            <input class="check-input-2" type="checkbox" id="checkbox2" name="checkbox01">
                                            <label class="red-color" id="own-vehicle-red" for="checkbox2"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <input type="hidden" id="own-vehicle" name="own_vehicle" value="">
                            <div class="form-group clearfix">
                                <div class="col-sm-6 padding-left-o">
                                    <label for="car-type" class="ride-label">Car Type <span class="right-into">:</span></label>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <input name="car_type" id="car-type" type="text" class="form-control" @if(isset($data->vd->car_type)) value="{{ $data->vd->car_type }}" @else value="{{ old('car_type') }}" @endif>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-6 padding-left-o">
                                    <label for="car-plate" class="ride-label">Car Plate No <span class="right-into">:</span></label>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <input name="car_plate_no" id="car-plate" type="text" class="form-control" @if(isset($data->vd->car_plate_no)) value="{{ $data->vd->car_plate_no }}" @else value="{{ old('car_plate_no') }}"  readonly @endif>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-6 padding-left-o">
                                    <label for="car-luggage" class="ride-label">MAXIMUM LUGGAGE <span class="right-into">:</span></label>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <input name="luggage_limit" id="car-luggage" type="text" class="form-control" @if(isset($data->vd->luggage_limit)) value="{{ $data->vd->luggage_limit }}" @else value="{{ old('car_plate_no') }}"  @endif>
                                </div>
                            </div>
                            @if(isset($data->vd))<input type="hidden" name="vd_action" id="vd_action" value="edit"><input type="hidden" name="vd_id" value="{{ $data->vd->id }}">@else <input type="hidden" id="vd_action" name="vd_action" value="add"> @endif
                        </div>
                        <div class="col-md-3 col-md-offset-2 col-sm-12 col-xs-12 col-xs-offset-0 ride-offer-button">
                            <ul class="get-ride-feature">
                                <li>
                                    <span class="left-ride-feature">Pets</span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox4" name="checkbox01" @foreach($data->rd as $rd)@if($rd->key == 'pets' && $rd->value == 'no') checked @endif @endforeach>
			        						<label class="red-color @foreach($data->rd as $rd)@if($rd->key == 'pets' && $rd->value == 'no') add-radio-color @endif @endforeach" id="pets-red" for="checkbox4"></label>
											<input class="check-input" type="checkbox" id="checkbox3" name="checkbox01" @foreach($data->rd as $rd)@if($rd->key == 'pets' && $rd->value == 'yes') checked @endif @endforeach>
			        						<label class="green-color @foreach($data->rd as $rd)@if($rd->key == 'pets' && $rd->value == 'yes') add-green-color @endif @endforeach" id="pets-green" for="checkbox3"></label>
									</span>
                                </li>
                                <li>
                                    <span class="left-ride-feature">Music</span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox5" name="checkbox01"  @foreach($data->rd as $rd)@if($rd->key == 'music' && $rd->value == 'no') checked @endif @endforeach>
			        						<label class="red-color @foreach($data->rd as $rd)@if($rd->key == 'music' && $rd->value == 'no') add-radio-color @endif @endforeach" id="music-red" for="checkbox5"></label>
											<input class="check-input" type="checkbox" id="checkbox6" name="checkbox01" @foreach($data->rd as $rd)@if($rd->key == 'music' && $rd->value == 'yes') checked @endif @endforeach>
			        						<label class="green-color @foreach($data->rd as $rd)@if($rd->key == 'music' && $rd->value == 'yes') add-green-color @endif @endforeach" id="music-green" for="checkbox6"></label>
									</span>
                                </li>
                                <li>
                                    <span class="left-ride-feature">Smoking</span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox7" name="checkbox01" @foreach($data->rd as $rd)@if($rd->key == 'smoking' && $rd->value == 'no') checked @endif @endforeach>
			        						<label class="red-color @foreach($data->rd as $rd)@if($rd->key == 'smoking' && $rd->value == 'no') add-radio-color @endif @endforeach" id="smoking-red" for="checkbox7"></label>
											<input class="check-input" type="checkbox" id="checkbox8" name="checkbox01" @foreach($data->rd as $rd)@if($rd->key == 'smoking' && $rd->value == 'yes') checked @endif @endforeach>
			        						<label class="green-color @foreach($data->rd as $rd)@if($rd->key == 'smoking' && $rd->value == 'yes') add-green-color @endif @endforeach" id="smoking-green" for="checkbox8"></label>
									</span>
                                </li>
                                <li>
                                    <span class="left-ride-feature">Max.2 in Back Seat </span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox9" name="checkbox01" @foreach($data->rd as $rd)@if($rd->key == 'back_seat' && $rd->value == 'no') checked @endif @endforeach>
			        						<label class="red-color @foreach($data->rd as $rd)@if($rd->key == 'back_seat' && $rd->value == 'no') add-radio-color @endif @endforeach" id="back-red" for="checkbox9"></label>
											<input class="check-input" type="checkbox" id="checkbox10" name="checkbox01" @foreach($data->rd as $rd)@if($rd->key == 'back_seat' && $rd->value == 'yes') checked @endif @endforeach>
			        						<label class="green-color @foreach($data->rd as $rd)@if($rd->key == 'back_seat' && $rd->value == 'yes') add-green-color @endif @endforeach" id="back-green" for="checkbox10"></label>
									</span>
                                </li>
                                <?php $edit_count = 0; ?>
                                @foreach($data->rd as $rd)
                                    @if(!in_array($rd->key, ['vehicle_id', 'pets', 'music', 'smoking', 'back_seat']))
                                        <?php $edit_count++; ?>
                                        <li>
                                            <span class="left-ride-feature">{{ $rd->key }} </span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="check-red-{{ $edit_count }}" name="checkbox01" @if($rd->value == 'no') checked @endif>
			        						<label class="red-color @if($rd->value == 'no') add-radio-color @endif" id="edit-red-{{ $edit_count }}" for="check-red-{{ $edit_count }}"></label>
											<input class="check-input" type="checkbox" id="check-green-{{ $edit_count }}" name="checkbox01" @if($rd->value == 'yes') checked @endif>
			        						<label class="green-color @if($rd->value == 'yes') add-green-color @endif" id="edit-green-{{ $edit_count }}" for="check-green-{{ $edit_count }}"></label>
									</span>
                                        </li>
                                            <input type="hidden" name="edit-id-{{ $edit_count }}" id="edit-id-{{ $edit_count }}" value="{{ $rd->id }}">
                                            <input type="hidden" name="edit-value-{{ $edit_count }}" id="edit-value-{{ $edit_count }}" value="{{ $rd->value }}">
                                    @endif
                                @endforeach
                            </ul>
                            <input type="hidden" name="total_edit" value="{{ $edit_count }}">
                            <input type="hidden" name="pets" id="pets" value="@foreach($data->rd as $rd)@if($rd->key == 'pets') {{ $rd->value }} @endif @endforeach">
                            <input type="hidden" name="music" id="music" value="@foreach($data->rd as $rd)@if($rd->key == 'music') {{ $rd->value }} @endif @endforeach">
                            <input type="hidden" name="smoking" id="smoking" value="@foreach($data->rd as $rd)@if($rd->key == 'smoking') {{ $rd->value }} @endif @endforeach">
                            <input type="hidden" name="back_seat" id="back" value="@foreach($data->rd as $rd)@if($rd->key == 'back_seat') {{ $rd->value }} @endif @endforeach">
                            <input type="hidden" name="ride_id" value="{{ $data->id }}">
                            <p id="added-items"></p>
                            <input type="hidden" name="total" id="total">
                            <button type="button" class="btn btn-info btn-offer" data-toggle="modal" data-target="#add-more">Add More <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="get-ride-offer-button text-center clearfix">
                        <button class="btn btn-info btn-offer" type="submit">Save</button>
                        <button class="btn btn-info btn-offer get-ride-button-cancel" type="button"><a style="color: #ffffff" href="{{ url('/d/ride-details/'.$data->link) }}">Cancel</a></button>
                    </div>
                    <!-- end ride description -->
                </div>
            </div>
        </div>
    </form>
    <!-- end offer a ride -->

    <!-- add more -->
    <div class="modal fade" id="add-more" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add More</h4>
                </div>
                <form id="item-save">
                    <div class="modal-body">
                        <div class="col-sm-12 padding-left-o padding-right-0">
                            <div class="form-group">
                                <input type="text" id="item-name" class="form-control" placeholder="Enter Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer login-modal-footer">
                        <button type="submit" id="add-desc" class="btn btn-info btn-offer">Save</button>
                        <button type="button" class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection