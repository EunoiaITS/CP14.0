<body>

<div class="wrapper">
    <!-- header area -->
    <div class="get-header">
        <div class="navbar nav">
            <div class="container">
                <div class="col-sm-2 col-xs-2 padding-left-0">
                    <div class="get-humber-icon" id="toggle-class">
							<span class="navi-trigger navi-icon">
								<svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
							</span>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-6">
                    <div class="get-logo text-center">
                        <a href="{{ url('/') }}"><h2 class="get-logo-text"><span>Get</span>Wobo.</h2></a>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-4 padding-right-0">
                    <div class="get-notification-area">
                        <div class="notification-badge">
                            <i class="fas fa-car"></i><span class="badge">{{ $notify_count->count() }}</span>
                        </div>
                        <!-- notification popupbar -->
                        <div class="get-notification-popupbar">
                            <h3 class="text-center">Notifications</h3>
                            <ul class="get-notificaton-list">
                                @foreach($notify as $n)
                                    <li onmousedown="readNot(event, '{{ $n->id }}');" class="@if($n->status == 'unread') {{ 'view-bookings-unread' }} @endif" id="notify-{{ $n->id }}">
                                        <div class="notificaton-text">
                                            <span class="get-notiline-text">
                                                <div class="notification-time"><i class="fas fa-clock"></i> <span>{{ date('d M Y', strtotime($n->created_at)) }} at {{ date('H:i a', strtotime($n->created_at)) }}</span></div>
                                                <?php echo $n->message; ?>
                                            </span>
                                            @if($n->ad_link != '')
                                            <a href="{{ $n->ad_link }}"><button class="btn btn-info get-notification">VISIT FOR DETAILS</button></a>
                                            @endif
                                        </div>
                                    </li>
                                    @endforeach
                            </ul>
                            <a href="@if(Auth::user()->role == 'customer') {{ url('/c/notifications') }} @endif @if(Auth::user()->role == 'driver') {{ url('/d/notifications') }} @endif" class="view-all">View All</a>
                        </div>
                        <div class="get-user-login">
                            <div class="login-icon">
                                <a href="@if(Auth::user()->role == 'customer'){{ url('/c/profile') }}@endif @if(Auth::user()->role == 'driver'){{ url('/d/profile') }}@endif"><img src="@if(isset($img))@if(Auth::user()->role == 'customer'){{ asset('public/uploads/customers/'.$img) }} @elseif(Auth::user()->role == 'driver') {{ asset('public/uploads/drivers/'.$img) }} @endif @else {{ asset('public/assets/frontend/img/pp.png') }} @endif" alt=""></a>
                            </div>
                            <a href="@if(Auth::user()->role == 'customer'){{ url('/c/profile') }}@endif @if(Auth::user()->role == 'driver'){{ url('/d/profile') }}@endif"><span class="get-loged-user">{{ Auth::user()->name }}</span></a>
                        </div>
                        <div class="logout-option">
                            <a href="#" data-toggle="modal" data-target="#myModalLogout"><i class="fas fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header area -->