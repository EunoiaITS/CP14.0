@if(Auth::check())
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script type="text/javascript">
    var user_id = '{{ Auth::id() }}';
    var notificationsWrapper   = $('.get-notification-popupbar');
    var notificationsToggle    = $('.notification-badge');
    var notificationsCountElem = notificationsToggle.find('span.badge');
    var notificationsCount     = parseInt(notificationsCountElem.text());
    var notifications          = notificationsWrapper.find('ul.get-notificaton-list');

    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('49d2ab12c4f6ada340da', {
        encrypted: true,
        cluster: 'ap2'
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('offer-created');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\OfferCreated', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = '<li class="view-bookings-unread">'+
                '<div class="notificaton-text">'+
                '<span class="get-notiline-text">'+
                '<div class="notification-time"><i class="fas fa-clock"></i> <span>'+data.time_at+'</span></div>'+
                data.msg+
                '</span>'+
                '<a href="'+data.ad_link+'"><button class="btn btn-info get-notification">VISIT FOR DEATILS</button></a>'+
                '</div>'+
                '</li>';
        if(data.ev == 'offer-created'){
            if(data.rec == user_id){
                notifications.html(newNotificationHtml + existingNotifications);

                notificationsCount += 1;
                notificationsCountElem.text(notificationsCount);
                notificationsWrapper.show();
            }
        }

        if(data.ev == 'ride-request'){
            @if(Auth::user()->role == 'driver')
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.text(notificationsCount);
            notificationsWrapper.show();
            @endif
            }

        if(data.ev == 'ride-booked'){
            if(data.rec == user_id){
                notifications.html(newNotificationHtml + existingNotifications);

                notificationsCount += 1;
                notificationsCountElem.text(notificationsCount);
                notificationsWrapper.show();
            }
        }

        if(data.ev == 'booking-accepted'){
            if(data.rec == user_id){
                notifications.html(newNotificationHtml + existingNotifications);

                notificationsCount += 1;
                notificationsCountElem.text(notificationsCount);
                notificationsWrapper.show();
            }
        }

        if(data.ev == 'booking-canceled'){
            if(data.rec == user_id){
                notifications.html(newNotificationHtml + existingNotifications);

                notificationsCount += 1;
                notificationsCountElem.text(notificationsCount);
                notificationsWrapper.show();
            }
        }

        if(data.ev == ''){}

        if(data.ev == ''){}

        if(data.ev == ''){}

        if(data.ev == ''){}

        if(data.ev == ''){}
    });

    function readNot(event, id){
        if(event.which == 1 || event.which == 2 || event.which == 3){
            $.ajax({
                url: '{{ url('/read-notification') }}',
                type: 'POST',
                data: {'id':id},
                dataType: 'json',
                success: function(data){
                    if(data.stat == 'true'){
                        $('#notify-'+id).removeAttr('class');
                    }
                }
            });
        }
    }
</script>
    @endif