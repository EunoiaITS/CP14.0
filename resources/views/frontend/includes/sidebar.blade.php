<!-- sidebar area -->
<div class="sidebar">
    <div class="siderbar-logo">
        <h3 class="sidebar-logo-class">GetWobo</h3>
        <div class="toggle-remove-class">
            <a href="#" id="toggle-remove">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            @if(!Auth::check())
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/join') }}">Join</a></li>
            @endif
            @if(Auth::check() && Auth::user()->role == 'driver')
                <li><a href="{{ url('/d/offer-ride') }}">Offer a Ride</a></li>
                <li><a href="{{ url('/d/active-offers') }}">My Active Offers</a></li>
                <li><a href="{{ url('/d/profile') }}">My Profile</a></li>
                <li><a href="{{ url('/d/ride-requests') }}">Ride Requests</a></li>
                <li><a href="{{ url('/d/notifications') }}">Notifications</a></li>
            @endif
            @if(Auth::check() && Auth::user()->role == 'customer')
                <li><a href="{{ url('/c/requests') }}">My Requests</a></li>
                <li><a href="{{ url('/c/bookings') }}">My Bookings</a></li>
                <li><a href="{{ url('/c/profile') }}">My Profile</a></li>
                <li><a href="{{ url('/c/notifications') }}">Notifications</a></li>
            @endif
            <li><a href="{{ url('/about-us') }}">About Us</a></li>
            <li><a href="{{ url('/terms') }}">Terms Of Services</a></li>
            <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
            <li><a href="{{ url('/popular') }}">Popular highlights</a></li>
            <li><a href="{{ url('/search') }}">Search</a></li>
            <li class="otherlist-item"><a href="#" class="disabled">Others <i class="fas fa-angle-down"></i></a>
                <ul class="main-dropdown-item">
                    <li><a href="{{ url('/copyright') }}">Copyright Policy</a></li>
                    <li><a href="{{ url('/non-discrimination') }}">Nondiscrimination Policy</a></li>
                    <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                </ul>
            </li>
            @if(Auth::check())
            <li data-toggle="modal" data-target="#myModalLogout"><a  class="disabled" href="#">Log Out</a></li>
            @endif
        </ul>
    </div>
</div>