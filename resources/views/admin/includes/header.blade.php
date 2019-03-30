<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="navi-trigger navi-icon">
						<svg viewBox="0 0 800 600">
                            <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                            <path d="M300,320 L540,320" id="middle"></path>
                            <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                        </svg>
					</span>
            </button>
            <a class="navbar-brand get-logo-text" href="{{ url('/admin') }}"><span>carhailing</span></a>
            <ul class="nav navbar-top-links navbar-right">
                <li><a style="color: #ffffff;" class="count-info" data-toggle="modal" data-target="#myModal" href="#"><span class="flaticon-logout"></span>Logout</a></li>
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>
