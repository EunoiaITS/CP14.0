<!--Add request popup -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog add-modal-item add-modal-item-get-ride" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">My Requests</h4>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="get-a-ride">
                        <div class="get-form-control">
                            <input type="text" name="from" id="" class="get-select-picker placepicker" title="From">
                        </div>
                        <div class="get-form-control">
                            <input type="text" name="to" id="" class="get-select-picker placepicker" title="To">
                        </div>
                        <div class="get-form-control">
                            <input type="text" placeholder="Pick a date" class="form-control datepicker-f">
                        </div>
                        <div class="get-form-control">
                            <select name="" id="" class="get-select-picker" title="REQUIRED SEATS">
                                <option value="10.00">10.00am</option>
                                <option value="11.00">11.00am</option>
                            </select>
                        </div>
                        <div class="get-form-control-button">
                            <button class="btn btn-info btn-offer">Get A Ride <i class="fas fa-car"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--change password -->

<div class="modal fade" id="myModalxss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Logging Out</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Confirm the Logging Out form carhailing ?</p>
            </div>
            <div class="modal-footer login-modal-footer">
                <form method="post" action="{{ url('/logout') }}">
                    {{ csrf_field() }}
                <button type="submit" class="btn btn-info btn-offer">Yes</button>
                <button type="button" class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end change password popup -->

@if(isset($reqs))
    @foreach($reqs as $req)
<!--Ridemate details -->
<div class="modal fade" id="myModalx{{ $req->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rider's Details</h4>
            </div>
            <div class="modal-body">
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Name <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $req->user_details->name }} {{ $req->user_data->last_name }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Email <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $req->user_details->email }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Age <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ date_diff(date_create($req->user_data->dob), date_create('today'))->y }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Gender <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $req->user_data->gender }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        @endforeach
    @endif
