@foreach($data as $book)
    @if($book->ride_details->status == 'active')

        <!-- cancel booking popup -->
        <div class="modal fade" id="myModalCancel{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Cancel Booking</h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <p>Are you sure you want to cancel your booking ?</p>
                    </div>
                    <div class="modal-footer login-modal-footer">
                        <form method="post" id="cancel-book" action="{{ url('/c/cancel-book') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <input type="hidden" name="page_url" value="{{ url()->current() }}">
                        </form>
                        <button type="submit" form="cancel-book" class="btn btn-info btn-offer">Confirm</button>
                        <button class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end cancel booking popup -->

        <!--Riders details -->
        <div class="modal fade" id="myModalRD{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ridemate Details</h4>
                    </div>
                    <div class="modal-body rider-details-ridemate">
                        <h3 class="rider-title">Ridemate</h3>
                        <div class="ridemate-name-area">
                            <div class="ridemate-name">
                                Name <span class="ridemate-right">:</span>
                            </div>
                            <div class="ridemate-name-xs">
                                <span>{{ $book->user->name }} {{ $book->ud->last_name }}</span>
                            </div>
                        </div>
                        <div class="ridemate-name-area">
                            <div class="ridemate-name">
                                Email <span class="ridemate-right">:</span>
                            </div>
                            <div class="ridemate-name-xs">
                                <span>{{ $book->user->email }}</span>
                            </div>
                        </div>

                        <div class="ridemate-name-area">
                            <div class="ridemate-name">
                                Gender <span class="ridemate-right">:</span>
                            </div>
                            <div class="ridemate-name-xs">
                                <span>{{ $book->ud->gender }}</span>
                            </div>
                        </div>
                        <div class="ridemate-name-area">
                            <div class="ridemate-name">
                                Age <span class="ridemate-right">:</span>
                            </div>
                            <div class="ridemate-name-xs">
                                <span>{{ date('Y') - date('Y',strtotime($book->ud->dob)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endforeach