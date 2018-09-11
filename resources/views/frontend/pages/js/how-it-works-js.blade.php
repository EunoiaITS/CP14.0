<script>
    $(document).ready(function () {
        $('#content').html('<p>This is a people powered community built on trust, with user friendly platform suitable for anyone, anytime, anywhere. All you need to do is to enjoy the ride. Welcome to getWOBO.</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Wanna get somewhere? NEED A RIDE? (for RIDERS)</h4>\n' +
            '                        <p><b>Step 1:</b> Find a ride</p>\n' +
            '                        <p>Just say where you’re heading, where you’re leaving from and when. Then pick a ride that works for you! If you need more detail, you can message your Ridemate before booking. You may also want to check out Ridemate\' profiles. You’ll see what others say about their ride with them.</p>\n' +
            '                        <p><b>Step 2:</b> Book and pay online</p>\n' +
            '                        <p>Tap book and pay for your seat. Once you do, you’ll have the Ridemate’s phone number to get in touch. If a Ridemate cancels, we’ll refund you according to our cancellation policy.</p>\n' +
            '                        <p><b>Step 2:</b> Riding together</p>\n' +
            '                        <p>Enjoy the ride and don’t forget to leave a rating!</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Have empty seats? OFFERING A RIDE? (for RIDEMATES)</h4>\n' +
            '                        <p><b>Step 1:</b> Offer a ride</p>\n' +
            '                        <p>Just say where you’re going, where you would like to pick up and drop off truest Riders, and when. Share your ride cost, it is just that easy for everyone!</p>\n' +
            '                        <p><b>Step 2:</b> Your Riders book a seat and pay online</p>\n' +
            '                        <p>When a Rider books a seat with you, we’ll share their phone number in case you need to get in touch. You can check out the details of the Riders anytime.</p>\n' +
            '                        <p><b>Step 2:</b> Ride together</p>\n' +
            '                        <p>Share stories, funs or just a quiet ride with other Riders.</p>\n' +
            '                        <br>\n' +
            '                        <h4 class="about-us-details-title text-center">Both Riders and Ridemates are visible to each other through this platform. This is how thing works</h4>\n' +
            '                        <p><i>Choose who you ride with:</i> You may see each other’s profile, ride details such as dates and point for pick-up & drop-off entirely at your convenient.</p>\n' +
            '                        <p><i>Check out their ratings:</i> See what others say about them, and benefit from the experience of other members when choosing who to ride with.</p>\n' +
            '                        <p><i>Find out more about them:</i> Check out their preferences and mini bio so you know all about who you’ll be travelling with.</p>\n' +
            '                        <p><i>Profiles are moderated:</i> All profiles, photos, ratings, rides and ride comments are moderated to maintain trust and respect in the community.</p>\n' +
            '                        <p><i>Get in touch before you travel:</i> Use our secure messaging system. Get to know each other before the ride and easily organise where to meet.</p>');
        var one = '';
        var two = '';
        $('#one').on('click',function (e) {
            e.preventDefault();
            $('#content-bx').html('');
            one = '<p>This is a people powered community built on trust, with user friendly platform suitable for anyone, anytime, anywhere. All you need to do is to enjoy the ride. Welcome to getWOBO.</p>\n' +
                '                        <br>\n' +
                '                        <h4 class="about-us-details-title text-center">Wanna get somewhere? NEED A RIDE? (for RIDERS)</h4>\n' +
                '                        <p><b>Step 1:</b> Find a ride</p>\n' +
                '                        <p>Just say where you’re heading, where you’re leaving from and when. Then pick a ride that works for you! If you need more detail, you can message your Ridemate before booking. You may also want to check out Ridemate\' profiles. You’ll see what others say about their ride with them.</p>\n' +
                '                        <p><b>Step 2:</b> Book and pay online</p>\n' +
                '                        <p>Tap book and pay for your seat. Once you do, you’ll have the Ridemate’s phone number to get in touch. If a Ridemate cancels, we’ll refund you according to our cancellation policy.</p>\n' +
                '                        <p><b>Step 2:</b> Riding together</p>\n' +
                '                        <p>Enjoy the ride and don’t forget to leave a rating!</p>\n' +
                '                        <br>\n' +
                '                        <h4 class="about-us-details-title text-center">Have empty seats? OFFERING A RIDE? (for RIDEMATES)</h4>\n' +
                '                        <p><b>Step 1:</b> Offer a ride</p>\n' +
                '                        <p>Just say where you’re going, where you would like to pick up and drop off truest Riders, and when. Share your ride cost, it is just that easy for everyone!</p>\n' +
                '                        <p><b>Step 2:</b> Your Riders book a seat and pay online</p>\n' +
                '                        <p>When a Rider books a seat with you, we’ll share their phone number in case you need to get in touch. You can check out the details of the Riders anytime.</p>\n' +
                '                        <p><b>Step 2:</b> Ride together</p>\n' +
                '                        <p>Share stories, funs or just a quiet ride with other Riders.</p>\n' +
                '                        <br>\n' +
                '                        <h4 class="about-us-details-title text-center">Both Riders and Ridemates are visible to each other through this platform. This is how thing works</h4>\n' +
                '                        <p><i>Choose who you ride with:</i> You may see each other’s profile, ride details such as dates and point for pick-up & drop-off entirely at your convenient.</p>\n' +
                '                        <p><i>Check out their ratings:</i> See what others say about them, and benefit from the experience of other members when choosing who to ride with.</p>\n' +
                '                        <p><i>Find out more about them:</i> Check out their preferences and mini bio so you know all about who you’ll be travelling with.</p>\n' +
                '                        <p><i>Profiles are moderated:</i> All profiles, photos, ratings, rides and ride comments are moderated to maintain trust and respect in the community.</p>\n' +
                '                        <p><i>Get in touch before you travel:</i> Use our secure messaging system. Get to know each other before the ride and easily organise where to meet.</p>';
            $('#content').html(one);
        });
        $('#two').on('click',function (e) {
            e.preventDefault();
            $('#content').html('');
            two = '<h4 class="about-us-details-title text-center">Ratings</h4>\n' +
                '                        <p>getWOBO’s rating system are merely visible recommendations as to foster decision making process prior to confirm any ride. This is important, the process helps to elevate trust within the community. So, please do not forget to rate to share your experience with the rest of the community after your ride.</p>\n' +
                '                        <p><b>How do I leave a rating?</b></p>\n' +
                '                        <p>You can leave a rating the day after you travel at your convenience. getWOBO rating system is applicable both for Riders and Ridemates.</p>\n' +
                '                        <p>Ratings done will be posted on each profile, applicable to both Riders and Ridemates and visible to the rest of the community. Follow these steps the next time you leave a rating:</p>\n' +
                '                        <ol>\n' +
                '                            <li>Choose the adjective that best describes your ride experience\n' +
                '                                <br>\n' +
                '                                <img src="{{ asset("public/assets/frontend/img/pic-1.png") }}" alt="picture">\n' +
                '                                <br>\n' +
                '                                <p>Think of whether you would recommend this person to your friends or family:</p>\n' +
                '                                <ol style="list-style-type: circle;">\n' +
                '                                    <li>Outstanding - An overall positive experience, can’t complain. </li>\n' +
                '                                    <li>Excellent - they were reliable, you felt comfortable and you had a very pleasant experience.</li>\n' +
                '                                    <li>Good - they were on time and it was an overall positive experience. </li>\n' +
                '                                    <li>Poor - Not a great experience. Wouldn’t recommend to others. </li>\n' +
                '                                    <li>Very Disappointing - To avoid. Never again.</li>\n' +
                '                                </ol>\n' +
                '                            </li>\n' +
                '                            <li>Add a few simple words perhaps. You can include whether the Ridemate was on time, played some banging tunes or told some great stories!</li>\n' +
                '                        </ol>\n' +
                '                        <p><b>How to rate:</b> If you’re a Rider, you can rate how the Ridemate behind the wheel. All cumulative ratings for Ridemate will be posted as average on their Profile. Vice versa for the Riders.</p>\n' +
                '                        <br>\n' +
                '                        <img src="{{ asset("public/assets/frontend/img/pic-2.png") }}" alt="picture">\n' +
                '                        <br>\n' +
                '                        <p></p>\n' +
                '                        <p><b>Replying to a rating:</b> No one wants to receive a negative rating, we understand that. To keep things fair, you can reply to a “Very disappointing,” “Poor” or “Good” rating. You have 14 days to reply. Once you have, we’ll display it on your Profile, under the rating you received. You can use your reply to give other members a better idea of what happened during the ride.</p>\n';
            $('#content-bx').html(two);
        });
    });
</script>