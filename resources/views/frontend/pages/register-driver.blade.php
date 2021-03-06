@extends('frontend.layout')
@section('content')

    <!-- sign in page -->
    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 sign-in-get-ad padding-left-o padding-right-o">
                    <h3 class="get-popular-list">Join</h3>
                    <h3 class="highlight">With Us Today!</h3>
                    <h4>MANDATORY fields are marked with a red asterisk  (<span class="star">*</span>)</h4>
                </div>
                <div class="clearfix"></div>
                @if(isset($errors))
                    @foreach($errors as $error)
                        <p class="alert alert-danger">
                            {{ $error }}
                        </p>
                @endforeach
                @endif
                <!-- search result page -->
                <form action="{{ url('/sign-up/driver') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="palceholder">
                                <label for="name">First Name <span class="star">*</span></label>
                            </div>
                            <input type="text" name="name" class="form-control" tabindex="1" required="required">
                        </div>
                        <div class="form-group">
                           <div class="palceholder">
					            <label for="name">Email <span class="star">*</span></label>
					        </div>
                            <input type="email" name="email" class="form-control" tabindex="3" required="required">
                        </div>
                        <div class="form-group">
                            <div class="palceholder">
					            <label for="name">Password <span class="star">*</span></label>
					        </div>
                            <input type="password" name="password" class="form-control" tabindex="5" required="required">
                        </div>
                        <div class="form-group">
                            <select name="country_code" class="form-control" tabindex="8">
                                @foreach($countries as $c)
                                    <option value="{{ $c->name . '(' . $c->country_code . ')' }}">{{ $c->name . '( ' . $c->country_code . ' )' }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group get-sign-up-mate">
                            <label for="date-of-birth">Date Of Birth <span class="star">*</span></label>
                            <div class="col-sm-3 padding-left-o">
                                <select name="day" id="" class="get-select-picker" tabindex="9" title="Day">
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="month" id="" class="get-select-picker" tabindex="10" title="Month">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="year" id="" class="get-select-picker" tabindex="11" title="Year">
                                    @for($i = 1930; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="last_name " class="form-control" placeholder="Last Name" tabindex="2" required="required">
                        </div>
                        <div class="form-group">
                           <div class="palceholder">
					            <label for="name">Confirm Email <span class="star">*</span></label>
					        </div>
                            <input type="email" name="reemail" class="form-control" tabindex="4" required="required">
                        </div>
                        <div class="form-group">
                            <div class="palceholder">
					            <label for="name">Confirm Password <span class="star">*</span></label>
					        </div>
                            <input type="password" name="repass" class="form-control" tabindex="6" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" name="contact" class="form-control" placeholder="Contact No" tabindex="7">
                        </div>
                        
                        <div class="form-group get-sign-up-mate">
                            <label for="gender">Gender <span class="star">*</span></label>
                            <select name="gender" id="" class="get-select-picker" tabindex="12" title="Gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="palceholder">
                                <label for="name">Address <span class="star">*</span></label>
                            </div>
                            <input type="text" name="address" class="form-control" tabindex="13" required="required">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="palceholder">
                                <label for="name">Car’s Plate Reg No. <span class="star">*</span></label>
                            </div>
                            <input type="text" name="car_reg" class="form-control" tabindex="14" required>
                        </div>
                        <div class="form-group">
                            <div class="palceholder">
                                <label for="name">Driving License No.  <span class="star">*</span></label>
                            </div>
                            <input type="text" name="driving_license" class="form-control" tabindex="15" required>
                        </div>
                    </div>
                    <div class="col-sm-5 sign-up-order-mm">
                        <div class="form-group">
                            <div class="palceholder">
                                <label for="name">MM/YY (Driving License Exp. Date)<span class="star">*</span></label>
                            </div>
                            <input type="text" name="expiry" class="form-control datepicker-d" tabindex="16" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group get-sign-up-mate">
                            <label for="upload-driving-licence">Upload Driving Lience (Max 2MB)<span class="star">*</span></label>
                            <div class="col-sm-6">
                                <div class="file btn btn-sm btn-primary">
                                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div><span>Upload jpg , png , pdf</span>
                                    <input type="file" class="input-upload" id="dl" name="dl_picture" tabindex="17" required>
                                </div>
                                <span class="col-sm-2" id="loading1"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 padding-left-o">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="palceholder">
                                    <label for="name">Identity Card No.  <span class="star">*</span></label>
                                </div>
                                <input type="text" name="id_card" class="form-control" tabindex="18" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group get-sign-up-mate">
                            <label for="upload-driving-licence">Upload Identity Card (Max 2MB)</label>
                            <div class="col-sm-6">
                                <div class="file btn btn-sm btn-primary">
                                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div><span>Upload jpg , png , pdf</span>
                                    <input type="file" class="input-upload" id="idc" name="idc_picture" tabindex="19">
                                </div>
                                <span class="col-sm-2" id="loading2"></span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="remember-me-option">
                            <input type="checkbox" id="checkbox1" name="checkbox">
                            <label for="checkbox1">I Agree to the <a href="{{ url('/privacy-policy') }}"> Privacy Policy</a> & <a href="{{ url('/privacy-policy') }}" class="sinuo-class"> Terms of Service</a>.</label>
                        </div>
                        <div class="sign-in-option-get">
                            <button class="btn btn-info btn-offer">Sign Up</button>
                        </div>
                        <h4>MANDATORY fields are marked with a red asterisk  (<span class="star">*</span>)</h4>
                    </div>
                    <input type="hidden" name="role" value="driver">
                </form>
            </div>
        </div>
    </div>
    <!-- end signin page -->

    @endsection
