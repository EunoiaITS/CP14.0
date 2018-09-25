@extends('admin.layout')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <h1 class="page-header">Ridemate Profile</h1>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="account-status">
                    <span>Account Status: <code>@if(isset($data->status)) @if($data->status == 'verified'){{ 'Unblocked' }} @else {{ 'Blocked' }} @endif @endif</code></span>
                    <div>Change Status:
                        <span class="btn btn-info btn-offer"  data-toggle="modal" data-target="#myModalxs{{ $data->id }}">block</span>
                        <span class="btn btn-info btn-offer"  data-toggle="modal" data-target="#myModalx{{ $data->id }}">Unblock</span> </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-3 col-xs-12">
                            <div class="user-profile-icon">
                                <img src="@if(isset($details->picture)){{ asset('/public/uploads/drivers/'.$details->picture) }} @endif" class="img-responsive" alt="profile-img">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="name-text">
                                <span class="name-text-user">Name</span>
                                <span class="name-text-name">{{ $data->name }} @if(isset($details->last_name)){{ $details->last_name }}@endif</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Email Address</span>
                                <span class="name-text-name">{{ $data->email }}</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Date Of birth</span>
                                <span class="name-text-name">{{ date('Y-m-d',strtotime($details->dob)) }}</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Gender</span>
                                <span class="name-text-name">{{ $details->gender }}</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Contact Number</span>
                                <span class="name-text-name">{{ $details->contact }}</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Driving Licence Number & expiry Date</span>
                                <span class="name-text-name">{{ $dd->driving_license }} <p>{{ date('Y-m',strtotime($dd->expiry)) }}</p></span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Identification  Card Number</span>
                                <span class="name-text-name">{{ $details->id_card }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rides
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Ride No.</th>
                                <th>Form</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Dept. Time</th>
                                <th>No. Of seats</th>
                                <th>Fare</th>
                                <th>Rides</th>
                                <th>Car Type</th>
                                <th>Car Plate No.</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($rides as $ride)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $ride->id }}</td>
                                <td>{{ $ride->origin }}</td>
                                <td>{{ $ride->destination }}</td>
                                <td>{{ $ride->created_at }}</td>
                                <td>{{ $ride->departure_time }}</td>
                                <td>{{ $ride->total_seats }}</td>
                                <td>{{ $ride->price_per_seat }}</td>
                                <td><span data-toggle="modal" data-target="#myModallx{{ $ride->id }}">Details</span></td>
                                <td>{{ $ride->vehicle->car_type }}</td>
                                <td>{{ $ride->vehicle->car_plate_no }}</td>
                                <td>{{ $ride->status }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <nav aria-label="Page navigation example" class="admin-pagination">
                    {{ $rides->links() }}
                </nav>
            </div>
        </div>
        <div class="clearfix text-center">
            <button class="btn btn-info btn-offer"  data-toggle="modal" data-target="#myModaln" >Review Income Statement</button>
        </div>
        <div class="modal fade income-statement-popup" id="myModaln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Statement Income </h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 padding-left-o padding-right-0">
                            <div class="col-sm-12 col-md-4">
                                <div class="statement-ridemate">
                                    <select name="" id="format-selector" class="get-select-picker" title="Select a category to choose the period of time">
                                        <option value="Daily">Daily Income</option>
                                        <option value="Weekly">Weekly Income</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                    <!-- live calender -->
                                    <!-- daily calender -->
                                    <div id="picker"></div>
                                    <button id="generate" rel="{{$data->id}}" class="btn btn-info btn-offer">Generate</button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8 ">
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Amount (USD)</th>
                                    </tr>
                                    </thead>
                                    <tbody id="income-data">
                                    </tbody>
                                </table>
                                <form action="" method="POST" role="form">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="monthly-income">Monthly Income</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer income-modal-footer clearfix">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <p class="back-link">© 2018. All rights reserved</p>
        </div>
    </div><!--/.row-->
    </div>	<!--/.main-->

    @endsection