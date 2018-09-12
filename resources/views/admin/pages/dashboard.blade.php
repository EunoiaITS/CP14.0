@extends('admin.layout')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Home</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel panel-teal panel-widget">
                            <div class="row no-padding">
                                <em class="fa fa-users">&nbsp;</em>
                                <div class="right-text">
                                    <div class="large">{{ $c }}</div>
                                    <div class="text-muted">Total Riders</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel panel-blue panel-widget">
                            <div class="row no-padding">
                                <em class="fa fa-users">&nbsp;</em>
                                <div class="right-text">
                                    <div class="large">{{ $d }}</div>
                                    <div class="text-muted">Total Ridemates</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        New Riders
                    </div>
                    <div class="panel-body">
                        <div class="panel-body tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Daily</a></li>
                                <li><a href="#tab2" data-toggle="tab">Weekly</a></li>
                                <li><a href="#tab3" data-toggle="tab">Monthly</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">
                                    <h3 class="bigtext">---</h3>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <h3 class="bigtext">---</h3>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    <h3 class="bigtext">---</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        New Ridemates
                    </div>
                    <div class="panel-body">
                        <div class="panel-body tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabx" data-toggle="tab">Daily</a></li>
                                <li><a href="#tab2x" data-toggle="tab">Weekly</a></li>
                                <li><a href="#tab3x" data-toggle="tab">Monthly</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tabx">
                                    <h3 class="bigtext">---</h3>
                                </div>
                                <div class="tab-pane fade" id="tab2x">
                                    <h3 class="bigtext">---</h3>
                                </div>
                                <div class="tab-pane fade" id="tab3x">
                                    <h3 class="bigtext">---</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rides
                        <ul class="pull-right panel-settings">
                            <li>
                                <p><span>Red : </span> Requests</p>
                            </li>
                            <li>
                                <p><span>Blue : </span> Created By Driver</p>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Income Statement
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4 col-md-6 col-xs-12 panel-body-border">
                            <form action="#">
                                <div class="form-group">
                                    <select class="form-control get-select-picker" title="Select">
                                        <option value="">Daily Income</option>
                                        <option value="">Weekly Income</option>
                                        <option value="">Monthly Income</option>
                                        <option value="">Yearly Income</option>
                                    </select>
                                </div>
                                <div id="calendar"></div>
                                <button class="btn btn-info btn-offer btn-center-admin">Generate</button>
                            </form>
                        </div>
                        <div class="col-lg-7 col-md-6 col-lg-offset-1 col-xs-12 table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ride No.</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
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
                                </tr>
                                <tr>
                                    <td>3</td>
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
    </div>	<!--/.main-->

    @endsection