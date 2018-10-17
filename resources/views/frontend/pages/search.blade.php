@extends('frontend.layout')
@section('content')
		<!-- search area -->
		<div class="search-area">
			<div class="container">
				<div class="row">
					<h2 class="get-section-header">Search</h2>
					<div class="search-get-ride">
					<form action="{{ url('/search') }}" method="post">
						{{ csrf_field() }}
						<div class="col-sm-3">
							<div class="form-group">
								<input type="text" name="from" id="" class="get-select-picker placepicker form-control" placeholder="From" required>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<input type="text" name="to" id="" class="get-select-picker placepicker form-control" placeholder="To" required>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<input type="text" name="when" class="form-control" id="datetimepicker5" placeholder="When" required oninvalid="this.setCustomValidity('You have to select time.')"
									   oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<select name="seats" class="get-select-picker" title="Seats" required>
									<option value="1">1 seats</option>
									<option value="2">2 seats</option>
									<option value="3">3 seats</option>
									<option value="4">4 seats</option>
									<option value="5">5 seats</option>
								</select>
							</div>
						</div>
						<div class="get-search-control clearfix">
							<button type="submit" class="btn btn-info btn-offer">Search</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
		@if(isset($data))
		<div class="get-offer-ride">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-12 highlight-get-popular padding-left-o padding-right-o">
						<h3 class="get-popular-list">Search result</h3>
						<h3 class="highlight">@if(isset($time)) {{  date('l',strtotime($time)) }}, {{ date('d F Y',strtotime($time)) }}@endif</h3>
					</div>
					<!-- search result page -->
					<div class="single-popular-item">
						<div class="col-md-10 col-md-offset-1 col-sm-12 popular-departure col-xs-12 padding-left-o">
							@if(isset($data->error))
								<h3 class="highlight">{{ $data->error }}</h3>
							@else
								@foreach($data as $d)
									@php $books = 0 @endphp
									@if($d->bookings->isNotEmpty())
										@foreach($d->bookings as $book)
											@php $books += $book->seat_booked @endphp
										@endforeach
									@endif
								@if($books != $d->total_seats)
									<div class="get-single-departure clearfix">
										<div class="col-sm-5">
											<div class="get-user-icon">
												<img src="<?php if(isset($d->usd->picture)){echo asset('public/uploads/drivers/'.$d->usd->picture);}?>" alt="">
											</div>
											<div class="get-user-details">
												<h3 class="get-user-name"><span>Name <span class="get-right-icon">:</span></span>
													<span class="get-dynamic-name">{{ $d->user->name }}</span></h3>
												<h3 class="get-user-name"><span>Age <span class="get-right-icon">:</span></span>
													<span class="get-dynamic-name">{{ date('Y') - date('Y',strtotime($d->usd->dob)) }}</span></h3>
												<h3 class="get-user-name"><span>From <span class="get-right-icon">:</span></span>
													<span class="get-dynamic-name">{{ $d->origin }}</span></h3>
												<h3 class="get-user-name"><span>To <span class="get-right-icon">:</span></span>
													<span class="get-dynamic-name">{{ $d->destination }}</span></h3>
												<h3 class="get-user-name"><span>Seats Available <span class="get-right-icon">:</span></span>
													<span class="get-dynamic-name"></span></h3>
													<ul class="get-user-icon-layer">
														@for($i = 0; $i < ($d->total_seats - $books); $i++)
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
													<h3 class="get-total-prize">{{ $d->price_per_seat }}{{' '}}{{ $d->currency }}</h3>
												</div>
												<a href="@if(Auth::check() && Auth::user()->role == 'driver') {{ url('/d/ride-details/'.$d->link) }} @elseif(Auth::check() && Auth::user()->role == 'customer') {{ url('/c/ride-details/'.$d->link) }} @else {{ url('/ride-details/'.$d->link) }} @endif"><button class="btn btn-info btn-offer text-uppercase">Details</button></a>
											</div>
										</div>
									</div>
									@endif
								@endforeach
							@endif
						</div>
					</div>
					<!-- end search result page -->
				</div>
			</div>
		</div>
	@endif
 @endsection
