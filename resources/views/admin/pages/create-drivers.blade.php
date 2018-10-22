@extends('admin.layout')
@section('title','Create Ridemate')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create Driver</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.messages')
                @if(isset($errors))
                    @foreach($errors as $error)
                        <p class="alert alert-danger">
                            {{ $error }}
                        </p>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="{{ url('/admin/create-driver') }}" role="form">
                            <fieldset>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter User Name" name="name" type="text" required="" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Last Name" name="last_name" value="{{ old('last_name') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Your Email" name="email" type="email" autofocus="" required="" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Re-type Password" name="repass" type="password" value="" required="">
                                </div>
                                <div class="form-group">
                                    <input type="datetime" class="form-control datepicker-f" placeholder="MM/YY" name="dob" value="{{ old('dob') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Id Card No" name="id_card" value="{{ old('id_card') }}">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="get-select-picker" title="Gender">
                                        <option value="male" @if(old('gender') == 'male'){{ 'selected' }}@endif>Male</option>
                                        <option value="female" @if(old('gender') == 'female'){{ 'selected' }}@endif>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="upload-driving-licence">Upload Picture</label>
                                    <div class="file">
                                        <input type="file" class="" name="picture">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Car's Registration No" name="car_reg" value="{{ old('car_reg') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Driving License No" name="driving_license" value="{{ old('driving_license') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Expiration Date" name="expiry" value="{{ old('expiry') }}">
                                </div>
                                <div class="form-group">
                                    <label for="upload-driving-licence">Upload Driving License</label>
                                    <div class="file">
                                        <input type="file" class="" name="uploads">
                                    </div>
                                </div>
                                <button class="btn btn-info btn-offer" type="submit">Create</button>
                            </fieldset>
                            <input type="hidden" name="role" value="driver">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <p class="back-link">© 2018. All rights reserved</p>
        </div>
    </div>	<!--/.main-->

    @endsection