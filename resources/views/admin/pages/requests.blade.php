@extends('admin.layout')
@section('title','Ride Details Requests')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rides Details (Ride Requests)</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Requests
                    </div>
                    <div class="panel-heading">
                        <span class="heading-option">Filter :</span>
                        <div class="filter-option">
                            <select class="form-control get-select-picker selectfilter" title="Filter">
                                <option value="ascending">A-Z</option>
                                <option value="descending">Z-A</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12 col-md-6 col-xs-12 table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ride No.</th>
                                    <th>Created By</th>
                                    <th>Form</th>
                                    <th>To</th>
                                    <th>Date</th>
                                    <th>Dept. Time</th>
                                    <th>Ridemate</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($reqs as $d)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->requester->name }}</td>
                                        <td>{{ $d->origin }}</td>
                                        <td>{{ $d->destination }}</td>
                                        <td>{{ date('d-M-Y H:i a', strtotime($d->created_at)) }}</td>
                                        <td>{{ date('d-M-Y H:i a', strtotime($d->departure_time)) }}</td>
                                        <th>{{ $d->mate->name }}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12">
                                    <nav aria-label="Page navigation example" class="admin-pagination">
                                        {{ $reqs->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <p class="back-link">© 2018. All rights reserved</p>
        </div>
    </div><!--/.row-->
@endsection
