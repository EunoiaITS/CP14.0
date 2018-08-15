@extends('frontend.layout')
@section('content')

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <h2 class="get-section-header">My Requests</h2>
                <div class="col-sm-12">
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
                <form method="post" id="delete-req" action="{{ url('/c/delete-request') }}">
                    {{ csrf_field() }}
                <h3>Active Requests</h3>
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <tbody>
                        @foreach($data as $d)
                            @if(empty($data->offer))
                        <tr>
                            <td><div class="table-form-form"><span>From :</span> <span class="right-text">{{ $d->from }}</span></div></td>
                            <td><div class="table-form-to"><span>To :</span> <span class="right-text">{{ $d->to }}</span></div></td>
                            <td><div class="table-form-req"><span>Requested Seats :</span> {{ $d->seat_required }} Seats</div></td>
                            <td><div class="table-form-req"><span>Date :</span> {{ date('d-M-Y H:i A', strtotime($d->departure_date)) }}</div></td>
                            <td>
                                <input type="checkbox" id="checkbox{{ $d->id }}" name="delete_req[]" value="{{ $d->id }}">
                                <label for="checkbox{{ $d->id }}"></label>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                    <h3>Expired Requests</h3>
                    <p>Your expired requests will be removed automatically within one week.</p>
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <tbody>
                            @foreach($ex_data as $d)
                                <tr>
                                    <td><div class="table-form-form"><span>From :</span> <span class="right-text">{{ $d->from }}</span></div></td>
                                    <td><div class="table-form-to"><span>To :</span> <span class="right-text">{{ $d->to }}</span></div></td>
                                    <td><div class="table-form-req"><span>Requested Seats :</span> {{ $d->seat_required }} Seats</div></td>
                                    <td><div class="table-form-req"><span>Date :</span> {{ date('d-M-Y H:i A', strtotime($d->departure_date)) }}</div></td>
                                    <td>
                                        <input type="checkbox" id="checkbox{{ $d->id }}" name="delete_req[]" value="{{ $d->id }}">
                                        <label for="checkbox{{ $d->id }}"></label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="get-add-request">
                    <button type="submit" class="btn btn-info btn-offer" form="delete-req">Delete Request</button>
                    <button type="button" class="btn btn-info btn-offer" data-toggle="modal" data-target="#myModal2">Add Request</button>
                </div>
            </div>
        </div>
    </div>
    <!--Add request popup -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog add-modal-item add-modal-item-get-ride" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">My Requests</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('/c/ride-request')}}">
                        {{ csrf_field() }}
                        <div class="get-a-ride">
                            <div class="get-form-control">
                                <input type="text" name="from" id="" class="get-select-picker placepicker form-control" placeholder="From" required value="{{ old('from') }}">
                            </div>
                            <div class="get-form-control">
                                <input type="text" name="to" id="" class="get-select-picker placepicker form-control" placeholder="To" required value="{{ old('to') }}">
                            </div>
                            <div class="get-form-control">
                                <input type="text" name="departure_date" placeholder="When" class="form-control" id="datetimepicker4" required value="{{ old('departure_date') }}">
                            </div>
                            <div class="get-form-control">
                                <select name="seat_required" id="" class="get-select-picker" title="Seats" required>
                                    <option value="1" @if(old('seat_required') == 1) selected @endif>1 Seat</option>
                                    <option value="2" @if(old('seat_required') == 2) selected @endif>2 Seats</option>
                                    <option value="3" @if(old('seat_required') == 3) selected @endif>3 Seats</option>
                                    <option value="4" @if(old('seat_required') == 4) selected @endif>4 Seats</option>
                                    <option value="5" @if(old('seat_required') == 5) selected @endif>5 Seats</option>
                                </select>
                            </div>
                            <div class="get-form-control-button">
                                <input type="hidden" name="req_url" value="{{ url()->current() }}">
                                <button type="submit" class="btn btn-info btn-offer">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection