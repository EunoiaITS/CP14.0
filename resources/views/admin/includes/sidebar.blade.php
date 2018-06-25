<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Username</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li @if(isset($slug) && $slug == 'home')class="active"@endif><a href="{{ url('/admin') }}"><em class="fa fa-home">&nbsp;</em> Home</a></li>
        <li class="parent @if(isset($slug) && $slug == 'addmin' || $slug == 'list'){{'active'}}@endif"><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-user">&nbsp;</em> Users (Admin) <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li @if(isset($slug) && $slug == 'addmin')class="active"@endif><a class="" href="{{ url('/admin/create-admin') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Create User
                    </a>
                </li>
                <li @if(isset($slug) && $slug == 'list')class="active"@endif>
                    <a class="" href="{{ url('/admin/list') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span>User Lists
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent @if(isset($slug) && $slug == 'customer' || $slug == 'list'){{'active'}}@endif"><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-user">&nbsp;</em> Riders (Customer) <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li @if(isset($slug) && $slug == 'customer')class="active"@endif><a class="" href="{{ url('/admin/create-customers') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Create Rider
                    </a>
                </li>
                <li @if(isset($slug) && $slug == 'customer')class="active"@endif>
                    <a class="" href="{{ url('/admin/customers') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Rider List
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent @if(isset($slug) && $slug == 'driver' || $slug == 'list'){{'active'}}@endif"><a data-toggle="collapse" href="#sub-item-3">
                <em class="fa fa-user">&nbsp;</em> Ridemates (Driver) <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-3">
                <li @if(isset($slug) && $slug == 'driver')class="active"@endif><a class="" href="{{ url('/admin/create-driver') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Create Ridemates
                    </a>
                </li>
                <li @if(isset($slug) && $slug == 'list')class="active"@endif>
                    <a class="" href="{{ url('/admin/drivers') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Ridemates List
                    </a>
                </li>
            </ul>
        </li>
        <li @if(isset($slug) && $slug == 'rides')class="active"@endif><a href="{{ url('/admin/rides') }}"><em class="fa fa-info-circle">&nbsp;</em>Rides Details</a></li>
    </ul>
</div><!--/.sidebar-->