@extends('admin.layout')
@section('title','Ridemate List')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ridemates List (Driver)</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="heading-option">Filter :</span>
                        <div class="filter-option">
                            <select class="form-control get-select-picker selectfilter" title="Filter">
                                <option value="ascending">A-Z</option>
                                <option value="descending">Z-A</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <table class="table table-hover" id="example" style="width:100%">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $count = 0 @endphp
                            @foreach($data as $d)
                                @php $count ++ @endphp
                                @if($d->status == 'verified' || $d->status == 'blocked')
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>@if($d->status == 'blocked'){{ 'Blocked' }}@else {{ 'Unblocked' }} @endif</td>
                                        <td><a href="{{ url('/admin/drivers/view/'.$d->id) }}" class="btn btn-info btn-offer">View</a></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
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