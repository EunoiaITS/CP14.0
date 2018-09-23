@extends('frontend.layout')
@section('content')
    <!-- populer highlight -->
    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12 col-sm-12 highlight-get-popular padding-left-o padding-right-o">
                    <div class="col-sm-7 col-xs-12 padding-left-o">
                        <h3 class="get-popular-list">List Of</h3>
                        <h3 class="highlight">Popular Highlights</h3>
                    </div>
                    <div class="col-sm-3 col-sm-offset-2 col-xs-12 padding-right-o">
                        <select name="" id="" class="get-select-picker" title="Popular by">
                            <option value="destination">Destination</option>
                            <option value="ridemate">Ridemate</option>
                            <option value="request-location">Request Location</option>
                        </select>
                    </div>
                </div>
                <!-- popular-single-item -->
                <div class="single-popular-item">
                    @foreach($data as $d)
                    <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12 padding-left-o popular-departure">
                        <div class="get-single-departure clearfix">
                            <div class="col-sm-5">
                                <div class="get-user-icon">
                                    <img src="" alt="">
                                </div>
                                <div class="get-user-details">
                                    <h3 class="get-user-name"><span>Name <span class="get-right-icon">:</span></span>
                                        <span class="get-dynamic-name">{{ $d->user->name }}</span></h3>
                                    <h3 class="get-user-name"><span>Age <span class="get-right-icon">:</span></span>
                                        <span class="get-dynamic-name">{{ date('Y') - date('Y',strtotime($d->usd->dob)) }}</span></h3>
                                    <h3 class="get-user-name"><span>Seats Available <span class="get-right-icon">:</span></span>
                                        <span class="get-dynamic-name"></span></h3>
                                    <ul class="get-user-icon-layer">
                                        @for($i = 1; $i <= $d->total_seats; $i++)
                                        <li><i class="fas fa-user"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="get-time-depatrue">
                                    <div class="time-departure">
                                        <span>Time Departure:</span>
                                        <p class="time">{{ date('d-m-Y h:i A',strtotime($d->departure_time)) }}</p>
                                    </div>
                                    <div class="time-departure">
                                        <span>Time Arrival:</span>
                                        <p class="time">{{ date('d-m-Y h:i A',strtotime($d->arrival_time)) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="get-user-ratings">
                                    <ul class="get-rate-user">
                                        <?php
                                            if($d->average > 0 && $d->average < 2){
                                                echo "<li><i class='fas fa-star'></i></li>";
                                            }
                                            elseif($d->average > 1 && $d->average < 3){
                                                echo "<li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>";
                                            }elseif($d->average >=3  && $d->average < 4){
                                                echo "<li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>";
                                            }elseif($d->average >= 4 && $d->average < 5){
                                                echo "<li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>";
                                            }elseif($d->average == 5){
                                                echo "<li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>
                                                      <li><i class='fas fa-star'></i></li>";
                                            }else{
                                                echo '';
                                            }
                                        ?>
                                    </ul>
                                    <div class="get-price">
                                        <h3 class="get-total-prize">${{ $d->price_per_seat }}</h3>
                                    </div>
                                    <a href="{{ url('/ride-details/'.$d->link) }}"><button class="btn btn-info btn-offer text-uppercase">Details</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-xs-12 col-lg-12">
                        <div class="getwobo-pagination">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end offer a ride -->
@endsection