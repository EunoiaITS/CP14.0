<script>
    $(document).ready(function(){
        /*--=========================
         ridemate ratings call
         ==========================--*/
        $('.click-performance .fas').click(function() {
            var val = parseInt($(this).attr('rel'));
            $('#rating').val(val);
            for(var j = 1; j <= 5; j++){
                $('#rate-'+j).removeClass('active-color');
            }
            for(var i = 1; i <= val; i++){
                $('#rate-'+i).addClass('active-color');
            }
        });
    });
</script>