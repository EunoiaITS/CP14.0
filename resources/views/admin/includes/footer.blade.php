<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Log Out</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout ?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ url('/logout') }}" id="logout">
                    {{ csrf_field() }}
                </form>
                <button type="submit" form="logout" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

@if(isset($modals))
    @include($modals)
@endif

<script src="{{ asset('public/assets/admin/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/chart.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/chart-data.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/easypiechart.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/easypiechart-data.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/custom.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/moment.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/jquery-ui-1.10.4.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/jquery-weekpicker.js') }}"></script>
<!-- data-table js -->

@if(isset($footer_js))
    @include($footer_js)
    @endif

</body>
</html>