@extends('admin.layout')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rides Details</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Rides
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4 col-md-6 col-xs-12 panel-body-border">
                            <form action="#">
                                <div class="form-group">
                                    <select class="form-control get-select-picker" title="Select">
                                        <option value="">Daily</option>
                                        <option value="">Weekly</option>
                                        <option value="">Monthly</option>
                                        <option value="">Yearly</option>
                                    </select>
                                </div>
                                <div id="calendar"></div>
                                <button class="btn btn-info btn-offer btn-center-admin">Generate</button>
                            </form>
                        </div>
                        <div class="col-lg-8 col-md-6 col-xs-12 table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ride No.</th>
                                    <th>Ridemate</th>
                                    <th>Form</th>
                                    <th>To</th>
                                    <th>Date</th>
                                    <th>Dept. Time</th>
                                    <th>Fare</th>
                                    <th>Car Plate No.</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="income">Income : <span> </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Requests
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4 col-md-6 col-xs-12 panel-body-border">
                            <form action="#">
                                <div class="form-group">
                                    <select class="form-control get-select-picker" title="Select">
                                        <option value="">Daily </option>
                                        <option value="">Weekly </option>
                                        <option value="">Monthly </option>
                                        <option value="">Yearly </option>
                                    </select>
                                </div>
                                <div id="calendar2"></div>
                                <button class="btn btn-info btn-offer btn-center-admin">Generate</button>
                            </form>
                        </div>
                        <div class="col-lg-8 col-md-6 col-xs-12 table-responsive">
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
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="income">Income : <span> </span></p>
                        </div>
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