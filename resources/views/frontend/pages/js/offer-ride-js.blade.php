<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    @if(isset($data->from))
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
            origin: document.getElementById('origin-input').value,
            destination: document.getElementById('destination-input').value,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
    }
    @else
    function initMap() {
        var map = new google.maps.Map(document.getElementById('googleMap'), {
            mapTypeControl: false,
            center: {lat: {{ session()->get('lat') }}, lng: {{ session()->get('lan') }}},
            zoom: 7
        });
        new AutocompleteDirectionsHandler(map);
    }
    /**
     * @constructor
     */
    function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'DRIVING';
        var originInput = document.getElementById('origin-input');
        var destinationInput = document.getElementById('destination-input');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);
        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {placeIdOnly: true});
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {placeIdOnly: true});
        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
    }
    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    AutocompleteDirectionsHandler.prototype.setupClickListener = function(id, mode) {
        var radioButton = document.getElementById(id);
        var me = this;
        radioButton.addEventListener('click', function() {
            me.travelMode = 'DRIVING';
            me.route();
        });
    };
    AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.place_id) {
                window.alert("Please select an option from the dropdown list.");
                return;
            }
            if (mode === 'ORIG') {
                me.originPlaceId = place.place_id;
            } else {
                me.destinationPlaceId = place.place_id;
            }
            me.route();
        });
    };
    AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
            return;
        }
        var me = this;
        this.directionsService.route({
            origin: {'placeId': this.originPlaceId},
            destination: {'placeId': this.destinationPlaceId},
            travelMode: this.travelMode
        }, function(response, status) {
            if (status === 'OK') {
                me.directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    };
            @endif
    var car_type = car_reg = luggage_limit = '';
    @if(isset($vd))
        car_type = '{{ $vd->car_type }}';
    car_reg = '{{ $vd->car_plate_no }}';
    luggage_limit = '{{ $vd->luggage_limit }}';
    @endif
    $('#checkbox1').on('click',function (e) {
        e.preventDefault();
        $('#own-vehicle-green').addClass('add-green-color');
        $('#own-vehicle-red').removeClass('add-radio-color');
        $('#own-vehicle').val('yes');
        $('#car-type').val(car_type);
        $('#car-plate').val(car_reg);
        $('#car-plate').attr('readonly', true);
        $('#car-luggage').val(luggage_limit);
        $('#vd_action').val('edit');
    });
    $('#checkbox2').on('click',function (e) {
        e.preventDefault();
        $('#own-vehicle-red').addClass('add-radio-color');
        $('#own-vehicle-green').removeClass('add-green-color');
        $('#own-vehicle').val('no');
        $('#car-type').val('');
        $('#car-plate').val('');
        $('#car-plate').attr('readonly', false);
        $('#car-luggage').val('');
        $('#vd_action').val('add');
    });
    $('#checkbox3').on('click',function (e) {
        e.preventDefault();
        $('#pets-green').addClass('add-green-color');
        $('#pets-red').removeClass('add-radio-color');
        $('#pets').val('yes');
    });
    $('#checkbox4').on('click',function (e) {
        e.preventDefault();
        $('#pets-red').addClass('add-radio-color');
        $('#pets-green').removeClass('add-green-color');
        $('#pets').val('no');
    });
    $('#checkbox5').on('click',function (e) {
        e.preventDefault();
        $('#music-red').addClass('add-radio-color');
        $('#music-green').removeClass('add-green-color');
        $('#music').val('no');
    });
    $('#checkbox6').on('click',function (e) {
        e.preventDefault();
        $('#music-green').addClass('add-green-color');
        $('#music-red').removeClass('add-radio-color');
        $('#music').val('yes');
    });
    $('#checkbox7').on('click',function (e) {
        e.preventDefault();
        $('#smoking-red').addClass('add-radio-color');
        $('#smoking-green').removeClass('add-green-color');
        $('#smoking').val('no');
    });
    $('#checkbox8').on('click',function (e) {
        e.preventDefault();
        $('#smoking-green').addClass('add-green-color');
        $('#smoking-red').removeClass('add-radio-color');
        $('#smoking').val('yes');
    });
    $('#checkbox9').on('click',function (e) {
        e.preventDefault();
        $('#back-red').addClass('add-radio-color');
        $('#back-green').removeClass('add-green-color');
        $('#back').val('no');
    });
    $('#checkbox10').on('click',function (e) {
        e.preventDefault();
        $('#back-green').addClass('add-green-color');
        $('#back-red').removeClass('add-radio-color');
        $('#back').val('yes');
    });

    var count = 0;
    var html = '';
    var itemName = '';
    $('#add-desc').on('click',function (e) {
        count++;
        e.preventDefault();
        itemName = $('#item-name').val();
        html = '<li>' +
        '<span class="left-ride-feature">'+itemName+'</span>' +
        '<span class="right-ride-feature">' +
        '<input class="check-input-2" type="checkbox" id="'+itemName+count+'">' +
        '<label class="red-color red-check" rel="'+count+'" id="red-label-'+count+'"></label>' +
        '<input class="check-input" type="checkbox" id="'+itemName+count+'">' +
        '<label class="green-color green-check" rel="'+count+'" id="green-label-'+count+'"></label>' +
        '</span>'+
        '</li>';
        $('.get-ride-feature').append(html);
        $('#total').val(count);
        $('#added-items').append('<input type="hidden" name="key-'+count+'" value="'+itemName+'"><input type="hidden" name="value-'+count+'" id="value-'+count+'" value="">');
    });
    $(document.body).on('click', '.red-check', function (ev) {
        ev.preventDefault();
        var rel = $(this).attr('rel');
        $('#red-label-'+rel).addClass('add-radio-color');
        $('#green-label-'+rel).removeClass('add-green-color');
        $('#value-'+rel).val('no');
    });
    $(document.body).on('click', '.green-check', function (ev) {
        ev.preventDefault();
        var rel = $(this).attr('rel');
        $('#red-label-'+rel).removeClass('add-radio-color');
        $('#green-label-'+rel).addClass('add-green-color');
        $('#value-'+rel).val('yes');
    });

    @if(isset($data->departure_date))
    var d_date = '{{ date('m/d/Y H:i a', strtotime($data->departure_date)) }}';
    d_date = d_date.match(/(\d+)\/(\d+)\/(\d+)\s*(\d+):(\d+)/);
    d_date  = new Date(d_date[3], d_date[1]-1, d_date[2], d_date[4], d_date[5], 0, 0);
    $("#datetimepicker-departure").data('DateTimePicker').minDate(d_date);
    d_date.setMinutes(d_date.getMinutes()+60);
    $("#Arrival-time").data('DateTimePicker').minDate(d_date);
    @endif

    $("#datetimepicker-departure").on('dp.change', function(ev){
        ev.preventDefault();
        var d = new Date(ev.date);
        d.setHours(d.getHours()+1);
        $("#Arrival-time").data('DateTimePicker').minDate(d);
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSDYEWgbPh1YBGNEZoMye44-F9ugukmRo&libraries=places&callback=initMap"
        async defer></script>