<script>
    $(document).ready(function () {
        $('input[type=file]').change(function(e){
            e.preventDefault;
            $('#loading').html('<img src="{{ asset('/public/assets/frontend/img/loading.gif') }}">');
            setTimeout(function() {
                $('#loading').html('');
            }, 2000);
        });
    });
</script>