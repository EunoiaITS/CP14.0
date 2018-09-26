<div class="modal fade" id="myModalxs{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <b>Block</b> <span>{{ $data->name }}</span> ?</p>
            </div>
        <form action="{{ url('/admin/block') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-footer">
                <input type="hidden" name="user_id" value="{{ $data->id }}">
                <button type="submit" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- unblock modal	 -->

<div class="modal fade" id="myModalx{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <b>Unblock</b> {{ $data->name }} ?</p>
            </div>
            <form action="{{ url('/admin/unblock') }}" method="post">
                {{ csrf_field() }}
            <div class="modal-footer">
                <input type="hidden" name="user_id" value="{{ $data->id }}">
                <button type="submit" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

@foreach($rides as $ride)
<!--Riders details -->
<div class="modal fade" id="myModallx{{ $ride->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Riders Details</h4>
            </div>
            <div class="modal-body rider-details-ridemate">
                @foreach($ride->books as $book)
                <h3 class="rider-title">Rider 1</h3>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Name <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $book->rider->name }}</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Email <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $book->rider->email }}</span>
                    </div>
                </div>

                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Gender <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>Male</span>
                    </div>
                </div>
                <div class="ridemate-name-area">
                    <div class="ridemate-name">
                        Occupied Seat <span class="ridemate-right">:</span>
                    </div>
                    <div class="ridemate-name-xs">
                        <span>{{ $book->seat_booked }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
    @endforeach