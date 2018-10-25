<script>
    $(document).ready(function () {
        $(document).ready(function () {
            $('#dl').change(function(e){
                e.preventDefault;
                $('#loading1').html('<i class="alert alert-success">Uploading...</i>');
                setTimeout(function() {
                    $('#loading1').html('<i class="alert alert-success">Uploaded</i>');
                }, 3000);
            });
            $('#idc').change(function(e){
                e.preventDefault;
                $('#loading2').html('<i class="alert alert-success">Uploading...</i>');
                setTimeout(function() {
                    $('#loading2').html('<i class="alert alert-success">Uploaded</i>');
                }, 3000);
            });
        });
    });
</script>