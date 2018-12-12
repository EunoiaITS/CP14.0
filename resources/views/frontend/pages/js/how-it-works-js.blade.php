<script>
    $(document).ready(function () {
        $('#content').html('<p>This is a people powered community built on trust, with user friendly platform suitable for anyone, anytime, anywhere. All you need to do is to enjoy the ride. Welcome to getWOBO.</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Wanna get somewhere? NEED A RIDE? (for RIDERS)</h4>\n' +
            '                        <p><b>Step 1:</b> Find a ride</p>\n' +
            '                        <p>Just say where you’re heading, where you’re leaving from and when. Then pick a ride that works for you! If you need more detail. You may also want to check out Ridemate' profiles. You’ll see what others say about their ride with them.</p>\n' +
            '                        <p><b>Step 2:</b> Book and Ride once Confirmed</p>\n' +
            '                        <p>Tap book for your seat at the price set by Ridemate. Once your booking request is confirmed by Ridemate, you may view Ridemate’s contacts in detail. Just communicate directly.</p>\n' +
            '                        <p><b>Step 3:</b> Riding together and Pay</p>\n' +
            '                        <p>Enjoy the ride, pay directly on the agreed price set upon booking, and don’t forget to leave a rating after the journey!</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Have empty seats? OFFERING A RIDE? (for RIDEMATES)</h4>\n' +
            '                        <p><b>Step 1:</b> Offer a ride</p>\n' +
            '                        <p>Just say where you’re going, from where and when. Set your available seats, language or any specific requirements, and then the ride cost, it is just that easy for everyone!</p>\n' +
            '                        <p><b>Step 2:</b> Your Riders book seat(s)</p>\n' +
            '                        <p>When a Rider books seat(s) with you, you need to confirm their book request. Thereafter, look for their phone number in case you need to get in touch. You can check out the details of the Riders anytime.</p>\n' +
            '                        <p><b>Step 2:</b> Ride together</p>\n' +
            '                        <p>Share stories, funs or just a quiet ride with other Riders. Expect payment and rating at the end of the journey.</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Both Riders and Ridemates are visible to each other through this platform. This is how thing works</h4>\n' +
            '                        <p><i>Choose who you ride with:</i> You may see each other’s profile, ride details such as dates and point for pick-up & drop-off and time, entirely at your convenient.</p>\n' +
            '                        <p><i>Check out their star ratings:</i> See how others rated them, and exercise common judgement prior to decide.</p>\n' +
            '                        <p><i>Find out more about them:</i> Check out their preferences and mini bio in their details, so you know all about who you’ll be travelling with.</p>\n' +
            '                        <p><i>Profiles are moderated:</i> All profiles, photos, ratings, rides and ride comments are moderated to maintain trust and respect in the community.</p>\n' +
            '                        <p><i>Get in touch before you travel:</i> Contact each other directly. Get to know each other before the ride and easily organise where to meet.</p>');
        var one = '';
        var two = '';
        $('.one').on('click',function (e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, 500);
            $('#content-bx').html('');
            one = '<p>This is a people powered community built on trust, with user friendly platform suitable for anyone, anytime, anywhere. All you need to do is to enjoy the ride. Welcome to getWOBO.</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Wanna get somewhere? NEED A RIDE? (for RIDERS)</h4>\n' +
            '                        <p><b>Step 1:</b> Find a ride</p>\n' +
            '                        <p>Just say where you’re heading, where you’re leaving from and when. Then pick a ride that works for you! If you need more detail. You may also want to check out Ridemate' profiles. You’ll see what others say about their ride with them.</p>\n' +
            '                        <p><b>Step 2:</b> Book and Ride once Confirmed</p>\n' +
            '                        <p>Tap book for your seat at the price set by Ridemate. Once your booking request is confirmed by Ridemate, you may view Ridemate’s contacts in detail. Just communicate directly.</p>\n' +
            '                        <p><b>Step 3:</b> Riding together and Pay</p>\n' +
            '                        <p>Enjoy the ride, pay directly on the agreed price set upon booking, and don’t forget to leave a rating after the journey!</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Have empty seats? OFFERING A RIDE? (for RIDEMATES)</h4>\n' +
            '                        <p><b>Step 1:</b> Offer a ride</p>\n' +
            '                        <p>Just say where you’re going, from where and when. Set your available seats, language or any specific requirements, and then the ride cost, it is just that easy for everyone!</p>\n' +
            '                        <p><b>Step 2:</b> Your Riders book seat(s)</p>\n' +
            '                        <p>When a Rider books seat(s) with you, you need to confirm their book request. Thereafter, look for their phone number in case you need to get in touch. You can check out the details of the Riders anytime.</p>\n' +
            '                        <p><b>Step 2:</b> Ride together</p>\n' +
            '                        <p>Share stories, funs or just a quiet ride with other Riders. Expect payment and rating at the end of the journey.</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Both Riders and Ridemates are visible to each other through this platform. This is how thing works</h4>\n' +
            '                        <p><i>Choose who you ride with:</i> You may see each other’s profile, ride details such as dates and point for pick-up & drop-off and time, entirely at your convenient.</p>\n' +
            '                        <p><i>Check out their star ratings:</i> See how others rated them, and exercise common judgement prior to decide.</p>\n' +
            '                        <p><i>Find out more about them:</i> Check out their preferences and mini bio in their details, so you know all about who you’ll be travelling with.</p>\n' +
            '                        <p><i>Profiles are moderated:</i> All profiles, photos, ratings, rides and ride comments are moderated to maintain trust and respect in the community.</p>\n' +
            '                        <p><i>Get in touch before you travel:</i> Contact each other directly. Get to know each other before the ride and easily organise where to meet.</p>';
            $('#content').html(one); 
        });
        $('.two').on('click',function (e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, 500);
            $('#content').html('');
            two = '<h4 class="about-us-details-title text-center">Ratings</h4>\n' +
                '                        <p>getWOBO’s rating system are merely visible recommendations as to foster decision making process prior to confirm any ride. This is important, the process helps to elevate trust within the community. So, please do not forget to rate to share your experience with the rest of the community after your ride.</p>';
            $('#content-bx').html(two);
        });
    });
</script>
