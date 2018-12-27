<body>

<div class="wrapper">
    <!-- header area -->
    <div class="get-header">
        <!-- header top area -->
        <div class="get-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="get-register">
                            <ul>
                                <li class="register"><a href="{{ url('/join') }}" style="text-decoration: none; color: white;">Register</a></li>
                                <li class="login"><a href="{{ url('/login') }}" style="text-decoration: none; color: white;">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header top area -->
        <div class="navbar nav">
            <div class="container">
                <div class="col-sm-1 col-xs-2 padding-left-0">
                    <!--<div class="get-humber-icon" id="toggle-class">
							<span class="navi-trigger navi-icon">
								<svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
							</span>
                    </div>-->
                </div>
                <div class="col-sm-7 col-xs-10">
                    <div class="get-logo text-center">
                        <a href="{{ url('/') }}"><h2 class="get-logo-text"><span>Get</span>Wobo.</h2></a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 padding-right-0">
                    <div class="get-offer-button">
                        <button class="btn btn-info btn-offer" type="button" class="btn btn-info btn-offer" data-toggle="modal" data-target="#myModalx2"><span>Find A Ride</span> <i class="fas fa-car"></i></button>
                        <a href="{{ url('/login') }}"><button class="btn btn-info btn-offer" type="button" class="btn btn-info btn-offer"><span>Offer a ride</span> <i class="fas fa-car"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header area -->
</div>
<!-- end header area -->
<!--Find a ride popup -->

<div class="modal fade" id="myModalx2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog add-modal-item add-modal-item-get-ride" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Find A Ride</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('/search') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="text" name="from" id="" data-live-search="true" class="get-select-picker placepicker form-control" placeholder="From" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="text" name="to" id="" data-live-search="true" class="get-select-picker placepicker form-control" placeholder="To" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="text" name="when" class="form-control" id="datetimepicker4" placeholder="When" required>
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
                        <button class="btn btn-info btn-offer">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>