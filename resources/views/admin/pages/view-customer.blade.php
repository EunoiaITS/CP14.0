@extends('admin.layout')
@section('title','Rider List')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <h1 class="page-header">Customer Profile</h1>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="account-status">
                    <span>Account Status: <code>@if(isset($data->status)) @if($data->status == 'verified'){{ 'Unblocked' }} @else {{ 'Blocked' }} @endif @endif</code></span>
                    <div>Change Status:
                        <button type="button" class="btn btn-info btn-offer @if(isset($data->status)) @if($data->status == 'blocked') disabled @endif @endif"  data-toggle="modal" data-target="#myModalxs{{ $data->id }}">block</button>
                        <button type="button" class="btn btn-info btn-offer @if(isset($data->status)) @if($data->status == 'verified') disabled @endif @endif"  data-toggle="modal" data-target="#myModalx{{ $data->id }}">Unblock</button>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-3 col-xs-12">
                            <div class="user-profile-icon">
                                <img src="@if(isset($details->picture)){{ asset('/public/uploads/customers/'.$details->picture) }} @else {{ asset('public/assets/frontend/img/pp.png') }} @endif" class="img-responsive" alt="profile-img">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="name-text">
                                <span class="name-text-user">Name</span>
                                <span class="name-text-name">{{ $data->name }}</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Email Address</span>
                                <span class="name-text-name">{{ $data->email }}</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Date Of birth</span>
                                <span class="name-text-name">@if(isset($details->dob)){{ date('d-m-Y',strtotime($details->dob)) }}@endif</span>
                            </div>
                            <div class="name-text">
                                <span class="name-text-user">Gender</span>
                                <span class="name-text-name">@if(isset($details->gender)){{ $details->gender }}@endif</span>
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
                        Booking (Completed Only)
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
                                <th>Ridemate</th>
                                <th>Car Type</th>
                                <th>Car Plate No.</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($books as $b)
                                @if(isset($b->details))
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $b->details->id }}</td>
                                <td>{{ $b->details->origin }}</td>
                                <td>{{ $b->details->destination }}</td>
                                <td>{{ date('d-M-Y H:i a', strtotime($b->details->created_at)) }}</td>
                                <td>{{ date('d-M-Y H:i a', strtotime($b->details->departure_time)) }}</td>
                                <td>{{ $b->seat_booked }}</td>
                                <td>{{ $b->details->price_per_seat }}</td>
                                <td>{{ $b->details->ridemate->name }}</td>
                                <td>{{ $b->details->vehicle->car_type }}</td>
                                <td>{{ $b->details->vehicle->car_plate_no }}</td>
                            </tr>
                            @endif
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
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>


        <div class="col-sm-12">
            <p class="back-link">© 2018. All rights reserved</p>
        </div>
    </div><!--/.row-->
    </div>	<!--/.main-->

    @endsection