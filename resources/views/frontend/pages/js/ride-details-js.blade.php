<script>
    $(document).ready(function(){
        /*--=========================
         ridemate ratings call
         ==========================--*/
        $('.click-performance .fas').click(function() {
            var val = parseInt($(this).attr('rel'));
            var user_id = $(this).attr('data-no');
            $('#rating'+user_id).val(val);
            for(var j = 1; j <= 5; j++){
                $('#rate-'+j+user_id).removeClass('active-color');
            }
            for(var i = 1; i <= val; i++){
                $('#rate-'+i+user_id).addClass('active-color');
            }
        });
    });
</script>
<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap(){
        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();

        var myOptions = {
            zoom:7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
        directionsDisplay.setMap(map);
        var request = {
            origin: '{{ $data->origin }}',
            destination: '{{ $data->destination }}',
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {

                directionsDisplay.setDirections(response);
            }
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSDYEWgbPh1YBGNEZoMye44-F9ugukmRo&libraries=places&callback=initMap"
        async defer></script>