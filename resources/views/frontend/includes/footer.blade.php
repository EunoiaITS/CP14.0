<!-- footer area -->

<footer class="get-footer-area">
    <div class="container text-center">
        <div class="row get-footer-line">
            <div class="get-footer"><a href="{{ url('/') }}"><h2 class="get-logo-text"><span>Get</span>Wobo.</h2></a></div>
            <ul class="social-icon">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
            <a href="{{ url('/terms') }}">Term of Services</a>
            <p>© {{ date('Y') }}. All rights reserved</p>
        </div>
    </div>
</footer>
</div>

@if(isset($modals))
    @include($modals)
    @endif

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- main js file -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ asset('public/assets/frontend/js/vendor/jquery-3.2.1.min.js') }}"><\/script>')</script>
<!-- bootstrap js -->
<script src="{{ asset('public/assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/frontend/js/plugins.js') }}"></script>
<!-- datepicker js -->
<script src="{{ asset('public/assets/frontend/js/moment.js') }}"></script>
<script src="{{ asset('public/assets/frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
<script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>
<script src="{{ asset('public/assets/frontend/js/zabuto_calendar.js') }}"></script>
<!-- nicescroll js -->
<script src="{{ asset('public/assets/frontend/js/jquery.nicescroll.min.js') }}"></script>
<!-- bootstrap selcet js -->
<script src="{{ asset('public/assets/frontend/js/bootstrap-select.js') }}"></script>
<!-- weekly picker js -->
<script src="{{ asset('public/assets/frontend/js/jquery-ui-1.10.4.js') }}"></script>
<script src="{{ asset('public/assets/frontend/js/jquery-weekpicker.js') }}"></script>
<!-- main js file -->
<script src="{{ asset('public/assets/frontend/js/custom.js') }}"></script>
    <script>
        $(document).ready(function(){
            var lat = lan = '';
            @if(session()->has('lat') && session()->has('lan'))
            lat = '{{ session()->get('lat') }}';
            lan = '{{ session()->get('lan') }}';
            @endif
            console.log('lat : '+lat+', lan : '+lan);
        });
    </script>

    @include('frontend.pages.js.notifications-js')

    @if(Auth::check())

        <!-- cancel booking popup -->
        <div class="modal fade" id="myModalLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Sign out</h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <p>Do you really want to log out?</p>
                    </div>
                    <div class="modal-footer login-modal-footer">
                        <form method="post" id="logout" action="{{ url('/logout') }}">
                            {{ csrf_field() }}
                        </form>
                        <button type="submit" form="logout" class="btn btn-info btn-offer">Yes</button>
                        <button class="btn btn-info btn-offer" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end cancel booking popup -->

    @endif

    @if(isset($js))
        @include($js)
        @endif

</body>
</html>
