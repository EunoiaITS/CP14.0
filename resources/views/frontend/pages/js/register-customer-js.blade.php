<script>
    $(document).ready(function () {
        $('input[type=file]').change(function(e){
            e.preventDefault;
            $('#loading').html('<i class="alert alert-success">Uploading...</i>');
            setTimeout(function() {
                $('#loading').html('<i class="alert alert-success">Uploaded</i>');
            }, 2000);
        });
    });
</script>