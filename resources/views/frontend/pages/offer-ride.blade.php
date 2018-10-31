@extends('frontend.layout')
@section('content')
    <!-- offer a ride -->
   <form action="{{ url('d/offer-ride') }}" method="post">
            {{csrf_field()}}
        <div class="get-offer-ride">
            <div class="container">
                <div class="row">
                    <h3 class="get-ride-title">Offer a Ride</h3>
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
                                <input name="origin" type="text" id="origin-input" placeholder="Enter a departure location" class="form-control" required="required" @if(isset($data->from)) value="{{ $data->from }}" readonly @else value="{{ old('origin') }}"  @endif>
                            </div>
                            <div class="form-group">
                                <label for="pickup-point">Destination</label>
                                <input name="destination" type="text" id="destination-input" placeholder="Enter a destination location" class="form-control" required="required" @if(isset($data->to)) value="{{ $data->to }}" readonly @else value="{{ old('destination') }}"  @endif>
                            </div>
                            <div class="col-sm-4 padding-left-o">
                                <div class="form-group">
                                    <label for="price">Price Per seat</label>
                                    <input name="price_per_seat" type="text" placeholder="$200" class="form-control form-control-placeholder" required="required" value="{{ old('price_per_seat') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="price">Currency</label>
                                    <select name="currency" class="form-control form-control-placeholder" required="required" value="{{ old('price_per_seat') }}">
                                        <option value="AFN">AFN</option>
                                        <option value="DZD">DZD</option>
                                        <option value="AOA">AOA</option>
                                        <option value="ATG">ATG</option>
                                        <option value="AWG">AWG</option>
                                        <option value="USDAru">USDAru</option>
                                        <option value="ARS">ARS</option>
                                        <option value="AUD">AUD</option>
                                        <option value="BSD">BSD</option>
                                        <option value="BHD">BHD</option>
                                        <option value="BDT">BDT</option>
                                        <option value="BBD">BBD</option>
                                        <option value="BZD">BZD</option>
                                        <option value="BTN">BTN</option>
                                        <option value="BOB">BOB</option>
                                        <option value="BWP">BWP</option>
                                        <option value="BRL">BRL</option>
                                        <option value="CA">CA</option>
                                        <option value="BND">BND</option>
                                        <option value="BIF">BIF</option>
                                        <option value="KY">KY</option>
                                        <option value="KHR">KHR</option>
                                        <option value="XAF">XAF</option>
                                        <option value="CVE">CVE</option>
                                        <option value="CLP">CLP</option>
                                        <option value="CNY">CNY</option>
                                        <option value="COP">COP</option>
                                        <option value="KMF">KMF</option>
                                        <option value="CRC">CRC</option>
                                        <option value="CUP">CUP</option>
                                        <option value="CDF">CDF</option>
                                        <option value="DJF">DJF</option>
                                        <option value="XCD">XCD</option>
                                        <option value="DOP">DOP</option>
                                        <option value="EGP">EGP</option>
                                        <option value="DKK">DKK</option>
                                        <option value="FKP">FKP</option>
                                        <option value="ERN">ERN</option>
                                        <option value="ETB">ETB</option>
                                        <option value="FJD">FJD</option>
                                        <option value="HKD">HKD</option>
                                        <option value="GMD">GMD</option>
                                        <option value="GHS">GHS</option>
                                        <option value="XCD">XCD</option>
                                        <option value="GTQ">GTQ</option>
                                        <option value="GNF">GNF</option>
                                        <option value="XOF">XOF</option>
                                        <option value="GYD">GYD</option>
                                        <option value="HTG">HTG</option>
                                        <option value="HNL">HNL</option>
                                        <option value="INR">INR</option>
                                        <option value="IMP">IMP</option>
                                        <option value="IDR">IDR</option>
                                        <option value="IRR">IRR</option>
                                        <option value="IQD">IQD</option>
                                        <option value="ILS">ILS</option>
                                        <option value="LIE">LIE</option>
                                        <option value="JMD">JMD</option>
                                        <option value="JPY">JPY</option>
                                        <option value="JOD">JOD</option>
                                        <option value="KES">KES</option>
                                        <option value="KPW">KPW</option>
                                        <option value="KRW">KRW</option>
                                        <option value="EUR">EUR</option>
                                        <option value="KWD">KWD</option>
                                        <option value="KGS">KGS</option>
                                        <option value="LAK">LAK</option>
                                        <option value="LBP">LBP</option>
                                        <option value="LSL">LSL</option>
                                        <option value="LRD">LRD</option>
                                        <option value="LYD">LYD</option>
                                        <option value="MOP">MOP</option>
                                        <option value="EUR">EUR</option>
                                        <option value="XCD">XCD</option>
                                        <option value="MGA">MGA</option>
                                        <option value="MWK">MWK</option>
                                        <option value="MYR">MYR</option>
                                        <option value="MVR">MVR</option>
                                        <option value="MRO">MRO</option>
                                        <option value="MUR">MUR</option>
                                        <option value="MXN">MXN</option>
                                        <option value="MDL">MDL</option>
                                        <option value="MNT">MNT</option>
                                        <option value="MAD">MAD</option>
                                        <option value="MZN">MZN</option>
                                        <option value="MMK">MMK</option>
                                        <option value="NAD">NAD</option>
                                        <option value="CFP">CFP</option>
                                        <option value="NPR">NPR</option>
                                        <option value="NZD">NZD</option>
                                        <option value="NIO">NIO</option>
                                        <option value="NGN">NGN</option>
                                        <option value="OMR">OMR</option>
                                        <option value="PKR">PKR</option>
                                        <option value="ILS">ILS</option>
                                        <option value="PAB">PAB</option>
                                        <option value="PGK">PGK</option>
                                        <option value="PYG">PYG</option>
                                        <option value="PEN">PEN</option>
                                        <option value="PHP">PHP</option>
                                        <option value="QAR">QAR</option>
                                        <option value="CDF">CDF</option>
                                        <option value="RWF">RWF</option>
                                        <option value="XCD">XCD</option>
                                        <option value="SHN">SHN</option>
                                        <option value="XCD">XCD</option>
                                        <option value="XCD">XCD</option>
                                        <option value="WST">WST</option>
                                        <option value="STD">STD</option>
                                        <option value="SAR">SAR</option>
                                        <option value="ANG">ANG</option>
                                        <option value="SCR">SCR</option>
                                        <option value="SLL">SLL</option>
                                        <option value="SGD">SGD</option>
                                        <option value="SBD">SBD</option>
                                        <option value="SOS">SOS</option>
                                        <option value="ZAR">ZAR</option>
                                        <option value="SSP">SSP</option>
                                        <option value="EUR">EUR</option>
                                        <option value="LKR">LKR</option>
                                        <option value="SDG">SDG</option>
                                        <option value="SRD">SRD</option>
                                        <option value="SZL">SZL</option>
                                        <option value="SYP">SYP</option>
                                        <option value="TWD">TWD</option>
                                        <option value="TJS">TJS</option>
                                        <option value="TZS">TZS</option>
                                        <option value="THB">THB</option>
                                        <option value="TOP">TOP</option>
                                        <option value="TTD">TTD</option>
                                        <option value="TND">TND</option>
                                        <option value="TMT">TMT</option>
                                        <option value="UGX">UGX</option>
                                        <option value="AED">AED</option>
                                        <option value="UYU">UYU</option>
                                        <option value="UZS">UZS</option>
                                        <option value="VUV">VUV</option>
                                        <option value="VEF">VEF</option>
                                        <option value="VND">VND</option>
                                        <option value="ESH">ESH</option>
                                        <option value="WF">WF</option>
                                        <option value="YER">YER</option>
                                        <option value="ZMW">ZMW</option>
                                        <option value="USD">USD</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="number-of-seat">Number Of Seats <span class="star">*</span></label>
                                    <select name="total_seats" id="" class="get-select-picker" title="Seats" required>
                                        <option value="1" @if(old('total_seats') == 1) selected @endif>1 Seat</option>
                                        <option value="2" @if(old('total_seats') == 2) selected @endif>2 Seats</option>
                                        <option value="3" @if(old('total_seats') == 3) selected @endif>3 Seats</option>
                                        <option value="4" @if(old('total_seats') == 4) selected @endif>4 Seats</option>
                                        <option value="5" @if(old('total_seats') == 5) selected @endif>5 Seats</option>
                                    </select>
                                    @if(isset($data->seat_required)) <input type="hidden" name="seat_booked" value="{{ $data->seat_required }}"> @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 pick--get-atime">
                            <div class="form-group ">
                                <label for="departure-time">Departure Time</label>
                                <div class="padding-left-o">
                                    <input name="d_date" type="text" class="form-control" id="datetimepicker-departure" placeholder="Pick a Date" required="required" @if(isset($data->departure_date)) value="{{ date('m/d/Y H:i A', strtotime($data->departure_date)) }}" readonly @else value="{{ old('d_date') }}" @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="departure-time">Arrival Time(Optional)</label>
                                <div class="padding-left-o">
                                    <input name="a_date" type="text" class="form-control" id="Arrival-time" placeholder="Pick a Date" required="required" @if(isset($data->departure_date)) value="{{ date('m/d/Y H:i A', strtotime($data->departure_date)+3600) }}" @else value="{{ old('a_date') }}" @endif>
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
                                            <label class="green-color @if(isset($vd)) add-green-color @endif" id="own-vehicle-green" for="checkbox1"></label>
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
                                    <label for="car-type" class="ride-label">Car Type <span class="star"></span><span class="right-into">:</span></label>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <input name="car_type" id="car-type" type="text" class="form-control" @if(isset($vd->car_type)) value="{{ $vd->car_type }}" @else value="{{ old('car_type') }}" @endif>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-6 padding-left-o">
                                    <label for="car-plate" class="ride-label">Car Plate No <span class="star">*</span><span class="right-into">:</span></label>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <input name="car_plate_no" id="car-plate" type="text" class="form-control" @if(isset($vd->car_plate_no)) value="{{ $vd->car_plate_no }}" @else value="{{ old('car_plate_no') }}"  readonly @endif>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-6 padding-left-o">
                                    <label for="car-luggage" class="ride-label">MAXIMUM LUGGAGE <span class="right-into">:</span></label>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <input name="luggage_limit" id="car-luggage" type="text" class="form-control" @if(isset($vd->luggage_limit)) value="{{ $vd->luggage_limit }}" @else value="{{ old('luggage_limit') }}"  @endif>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-6 padding-left-o">
                                    <label for="language" class="ride-label">Language <span class="right-into">:</span></label>
                                </div>
                                <div class="col-sm-6 padding-ride-o">
                                    <input name="language" id="language" type="text" class="form-control" @if(isset($vd->language)) value="{{ $vd->language }}" @else value="{{ old('language') }}"  @endif>
                                </div>
                            </div>
                            @if(isset($vd))<input type="hidden" name="vd_action" id="vd_action" value="edit"><input type="hidden" name="vd_id" value="{{ $vd->id }}">@else <input type="hidden" id="vd_action" name="vd_action" value="add"> @endif
                        </div>
                        <div class="col-md-3 col-md-offset-2 col-sm-12 col-xs-12 col-xs-offset-0 ride-offer-button">
                            <ul class="get-ride-feature">
                                <li>
                                    <span class="left-ride-feature">Pets</span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox4" name="checkbox01" @if(old('pets') == 'no') checked @endif>
			        						<label class="red-color @if(old('pets') == 'no') add-radio-color @endif" id="pets-red" for="checkbox4"></label>
											<input class="check-input" type="checkbox" id="checkbox3" name="checkbox01" @if(old('pets') == 'yes') checked @endif>
			        						<label class="green-color @if(old('pets') == 'yes') add-green-color @endif" id="pets-green" for="checkbox3"></label>
									</span>
                                </li>
                                <li>
                                    <span class="left-ride-feature">Music</span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox5" name="checkbox01"  @if(old('music') == 'no') checked @endif>
			        						<label class="red-color @if(old('music') == 'no') add-radio-color @endif" id="music-red" for="checkbox5"></label>
											<input class="check-input" type="checkbox" id="checkbox6" name="checkbox01" @if(old('music') == 'yes') checked @endif>
			        						<label class="green-color @if(old('music') == 'yes') add-green-color @endif" id="music-green" for="checkbox6"></label>
									</span>
                                </li>
                                <li>
                                    <span class="left-ride-feature">Smoking</span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox7" name="checkbox01" @if(old('smoking') == 'no') checked @endif>
			        						<label class="red-color @if(old('smoking') == 'no') add-radio-color @endif" id="smoking-red" for="checkbox7"></label>
											<input class="check-input" type="checkbox" id="checkbox8" name="checkbox01" @if(old('smoking') == 'yes') checked @endif>
			        						<label class="green-color @if(old('smoking') == 'yes') add-green-color @endif" id="smoking-green" for="checkbox8"></label>
									</span>
                                </li>
                                <li>
                                    <span class="left-ride-feature">Max.2 in Back Seat </span>
                                    <span class="right-ride-feature">
											<input class="check-input-2" type="checkbox" id="checkbox9" name="checkbox01" @if(old('back_seat') == 'no') checked @endif>
			        						<label class="red-color @if(old('back_seat') == 'no') add-radio-color @endif" id="back-red" for="checkbox9"></label>
											<input class="check-input" type="checkbox" id="checkbox10" name="checkbox01" @if(old('back_seat') == 'yes') checked @endif>
			        						<label class="green-color @if(old('back_seat') == 'yes') add-green-color @endif" id="back-green" for="checkbox10"></label>
									</span>
                                </li>
                            </ul>
                            <input type="hidden" name="pets" id="pets" value="{{ old('pets') }}">
                            <input type="hidden" name="music" id="music" value="{{ old('music') }}">
                            <input type="hidden" name="smoking" id="smoking" value="{{ old('smoking') }}">
                            <input type="hidden" name="back_seat" id="back" value="{{ old('back_seat') }}">
                            <p id="added-items"></p>
                            <input type="hidden" name="total" id="total">
                            <button type="button" id="add-more" data-toggle="modal" data-target="#myModalx" class="btn btn-info btn-offer">Add More <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="get-ride-offer-button text-center clearfix">
                        <button type="submit" class="btn btn-info btn-offer">Offer Ride</button>
                    </div>
                    <!-- end ride description -->
                </div>
            </div>
        </div>
       @if($req_id != '')<input type="hidden" name="req_id" value="{{ $req_id }}"><input type="hidden" name="req_user_id" value="{{ $data->user_id }}">@endif
    </form>
    <!-- end offer a ride -->
    <div class="modal fade" id="myModalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
