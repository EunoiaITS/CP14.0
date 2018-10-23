@extends('frontend.layout')
@section('content')

    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                <!-- Ride details -->
                <div class="get-ridemate-single">
                    <h3 class="check-total-fare text-center">Notifications</h3>

                    @foreach($data as $d)

                        <!-- single notification area -->
                        <div onmousedown="readNot(event, '{{ $d->id }}');" class="col-md-8 col-md-offset-2  col-sm-12 col-xs-12 ridemate-notification-offer padding-left-o @if($d->status == 'unread') {{ 'read-notification' }} @endif" id="not-not-{{ $d->id }}">
                            <div class="col-sm-8 col-xs-10 padding-left-o">
                                <div class="get-car-details-area clearfix">
                                    <span><?php echo $d->message; ?></span>
                                    <div class="notification-time"><i class="fas fa-clock"></i> <span>{{ date('d M Y', strtotime($d->created_at)) }} at {{ date('H:i a', strtotime($d->created_at)) }}</span></div>
                                </div>
                            </div>
                            @if($d->ad_link != '')
                            <div class="col-sm-4 col-xs-2 ride-details-feature">
                                <a href="{{ $d->ad_link }}"><button class="btn btn-info btn-offer">Visit for Details</button></a>
                            </div>
                                @endif
                        </div>
                        <!-- end single notification area -->

                        @endforeach

                </div>
                <!-- end ridemate details -->
                <div class="col-xs-12 col-lg-12">
                    <div class="getwobo-pagination">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection