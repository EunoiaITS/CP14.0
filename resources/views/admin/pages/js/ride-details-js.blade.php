<script>
    $(document).ready(function(){
        $('#search-ops').on('change', function(e){
            e.preventDefault();
            var opt = $(this).val();
            if(opt === 'd'){
                $('#calender').datetimepicker({
                    inline: true,
                    format: 'DD',
                    viewMode: 'days',
                });
            }
        });
    });
</script>