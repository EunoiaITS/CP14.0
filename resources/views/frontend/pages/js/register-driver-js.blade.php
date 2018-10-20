<script>
    $(document).ready(function () {
        $(document).ready(function () {
            $('#dl').change(function(e){
                e.preventDefault;
                $('#loading1').html('<img src="{{ asset('/public/assets/frontend/img/loading.gif') }}">');
                setTimeout(function() {
                    $('#loading1').html('');
                }, 2000);
            });
            $('#idc').change(function(e){
                e.preventDefault;
                $('#loading2').html('<img src="{{ asset('/public/assets/frontend/img/loading.gif') }}">');
                setTimeout(function() {
                    $('#loading2').html('');
                }, 2000);
            });
        });
    });
</script>