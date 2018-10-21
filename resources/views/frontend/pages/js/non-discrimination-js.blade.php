<script>
    $(document).ready(function () {
        $('#content').html('<h4 class="about-us-details-title">Our Commitment to Inclusion and Respect</h4>\n' +
            '<p>GetWOBO is, at its core, an open community dedicated to bring the world closer together by fostering meaningful, shared experiences among people from all parts of the world. Our community includes millions of people from virtually every country on the globe. It is an incredibly diverse community, drawing together individuals of different cultures, values, and norms.</p>\n' +
            '<p>The GetWOBO community is committed to building a world where people from every background feel welcome and respected, no matter where they are from. This commitment rests on two foundational principles that apply both to GetWOBO’s Ridemates and Riders: <b>Inclusion and Respect.</b></p>\n' +
            '<p>Our shared commitment to these principles enables every member of our community to feel welcome on the GetWOBO platform no matter who they are, where they come from, how they worship, or whom they love. GetWOBO recognizes that some jurisdictions permit, or require, distinctions among individuals based on factors such as national origin, gender, marital status or sexual orientation, and it does not require members to violate local laws or take actions that may subject them to legal liability. GetWOBO will provide additional guidance and adjust this nondiscrimination policy to reflect such permissions and requirements in the jurisdictions where they exist.</p>\n' +
            '<p>While we do not believe that one company can mandate harmony among all people, we do believe that the GetWOBO community can promote empathy and understanding across all cultures. We are all committed to doing everything we can to help eliminate all forms of unlawful bias, discrimination, and intolerance from our platform. We want to promote a culture within the GetWOBO community —Ridemates, Riders, Members and people just considering whether to use our platform — that goes above and beyond mere compliance. To that end, all of us, GetWOBO employees, Ridemates, Riders and Members alike, agree to read and act in accordance with the following policy to strengthen our community and realize our mission of ensuring that everyone can belong, and feels welcome, anywhere.</p>\n' +
            '<ol style="list-style-type: circle;">\n' +
            '<li><b>Inclusion</b> – We welcome members of all backgrounds with authentic hospitality and open minds. Joining GetWOBO, as a Ridemates or Riders, means becoming part of a community of inclusion. Bias, prejudice, racism, and hatred have no place on our platform or in our community. While Members are required to follow all applicable laws that prohibit discrimination based on such factors as race, religion, national origin, and others listed below, we commit to do more than comply with the minimum requirements established by law.</li>\n' +
            '<li><b>Respect</b> – We are respectful of each other in our interactions and encounters. GetWOBO appreciates that local laws and cultural norms vary around the world and expects our Members to abide by local laws, and to engage with each other respectfully, even when views may not reflect their beliefs or upbringings. GetWOBO’s members bring to our community an incredible diversity of background experiences, beliefs, and customs. By connecting people from different backgrounds, GetWOBO fosters greater understanding and appreciation for the common characteristics shared by all human beings and undermines prejudice rooted in misconception, misinformation, or misunderstanding.</li>\n' +
            '</ol>');
        var one = '';
        var two = '';
        var three = '';
        var current = 1;
        $('#one').on('click',function (e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, 500);
            current = 1;
            one = '<h4 class="about-us-details-title">Our Commitment to Inclusion and Respect</h4>\n' +
                '<p>GetWOBO is, at its core, an open community dedicated to bring the world closer together by fostering meaningful, shared experiences among people from all parts of the world. Our community includes millions of people from virtually every country on the globe. It is an incredibly diverse community, drawing together individuals of different cultures, values, and norms.</p>\n' +
                '<p>The GetWOBO community is committed to building a world where people from every background feel welcome and respected, no matter where they are from. This commitment rests on two foundational principles that apply both to GetWOBO’s Ridemates and Riders: <b>Inclusion and Respect.</b></p>\n' +
                '<p>Our shared commitment to these principles enables every member of our community to feel welcome on the GetWOBO platform no matter who they are, where they come from, how they worship, or whom they love. GetWOBO recognizes that some jurisdictions permit, or require, distinctions among individuals based on factors such as national origin, gender, marital status or sexual orientation, and it does not require members to violate local laws or take actions that may subject them to legal liability. GetWOBO will provide additional guidance and adjust this nondiscrimination policy to reflect such permissions and requirements in the jurisdictions where they exist.</p>\n' +
                '<p>While we do not believe that one company can mandate harmony among all people, we do believe that the GetWOBO community can promote empathy and understanding across all cultures. We are all committed to doing everything we can to help eliminate all forms of unlawful bias, discrimination, and intolerance from our platform. We want to promote a culture within the GetWOBO community —Ridemates, Riders, Members and people just considering whether to use our platform — that goes above and beyond mere compliance. To that end, all of us, GetWOBO employees, Ridemates, Riders and Members alike, agree to read and act in accordance with the following policy to strengthen our community and realize our mission of ensuring that everyone can belong, and feels welcome, anywhere.</p>\n' +
                '<ol style="list-style-type: circle;">\n' +
                '<li><b>Inclusion</b> – We welcome members of all backgrounds with authentic hospitality and open minds. Joining GetWOBO, as a Ridemates or Riders, means becoming part of a community of inclusion. Bias, prejudice, racism, and hatred have no place on our platform or in our community. While Members are required to follow all applicable laws that prohibit discrimination based on such factors as race, religion, national origin, and others listed below, we commit to do more than comply with the minimum requirements established by law.</li>\n' +
                '<li><b>Respect</b> – We are respectful of each other in our interactions and encounters. GetWOBO appreciates that local laws and cultural norms vary around the world and expects our Members to abide by local laws, and to engage with each other respectfully, even when views may not reflect their beliefs or upbringings. GetWOBO’s members bring to our community an incredible diversity of background experiences, beliefs, and customs. By connecting people from different backgrounds, GetWOBO fosters greater understanding and appreciation for the common characteristics shared by all human beings and undermines prejudice rooted in misconception, misinformation, or misunderstanding.</li>\n' +
                '</ol>';
            $('#content').html(one);
        });
        $('#two').on('click',function (e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, 500);
            current = 2;
            two = '<h4 class="about-us-details-title">Specific Guidance for getWOBO Members</h4>\n' +
                '<p>As a general matter, we will familiarize ourselves with all applicable federal, state, and local laws that apply to vehicle ride on sharing basis. Ridemates should contact GetWOBO customer service if they have any questions about their obligations to comply with this GetWOBO Nondiscrimination Policy. Guided by these principles, our community will follow these rules:</p>\n' +
                '<p><b>Race, Color, Ethnicity, National Origin, Religion, Sexual Orientation, Gender Identity, or Marital Status</b></p>\n' +
                '<ol style="list-style-type: square;">\n' +
                '<li>GetWOBO Ridemates <b>may not :</b>\n' +
                '<ol style="list-style-type: circle;">\n' +
                '<li>Decline a Rider based on race, color, ethnicity, national origin, religion, sexual orientation, gender identity, or marital status.</li>\n' +
                '<li>Impose any different terms or conditions based on race, color, ethnicity, national origin, religion, sexual orientation, gender identity, or marital status.</li>\n' +
                '<li>Post any Ride Services or make any statement that discourages or indicates a preference for or against any guest on account of race, color, ethnicity, national origin, religion, sexual orientation, gender identity, or marital status.</li>\n' +
                '</ol>\n' +
                '</li>\n' +
                '<b>Gender</b>\n' +
                '<li>GetWOBO Ridemates <b>may not :</b>\n' +
                '<ol style="list-style-type: circle;">\n' +
                '<li>Decline to provide Ride Services to Riders based on gender.</li>\n' +
                '<li>Impose any different terms or conditions based on gender on the actual ride itself.</li>\n' +
                '<li>Post any Ride Services or make any statement that discourages or indicates a preference for or against any Riders on account of gender.</li>\n' +
                '</ol>\n' +
                '</li>\n' +
                '<b>Disability</b>\n' +
                '<li>GetWOBO Ridemates <b>may not :</b>\n' +
                '<ol style="list-style-type: circle;">\n' +
                '<li>Decline a Rider based on any actual or perceived disability.</li>\n' +
                '<li>Impose any different terms or conditions based on the fact that the Rider has a disability.</li>\n' +
                '<li>Inquire about the existence or severity of a Rider’s disability, or the means used to accommodate any disability. If, however, a potential Rider raises his or her disability, a Ridemate may, and should, discuss with the potential Rider whether the Ride Services meet the potential Rider’s needs.</li>\n' +
                '<li>Prohibit or limit the use of mobility devices.</li>\n' +
                '<li>Charge more in Ride or other fees for Riders with disabilities.</li>\n' +
                '<li>Post any Ride Services or make any statement that discourages or indicates a preference for or against any Rider on account of the fact that the Rider has a disability.</li>\n' +
                '<li>Refuse to communicate with Riders through accessible means that are available, including relay operators (for people with hearing impairments) and e-mail (for people with vision impairments using screen readers).</li>\n' +
                '<li>Refuse to provide reasonable Rides, including flexibility when Riders with disabilities request modest changes in your Ride route, such as picking up at the spot near to their residential unit. When a Rider requests such additional request, the Ridemates and the Rider should engage in a dialogue to explore mutually agreeable ways to ensure the outcome meets the Rider’s needs.</li>\n' +
                '\n' +
                '</ol>\n' +
                '</li>\n' +
                '<b>Personal Preferences</b>\n' +
                '<li>GetWOBO Ridemates <b>may :</b>\n' +
                '<ol style="list-style-type: circle;">\n' +
                '<li>Except as noted above, GetWOBO Ridemates may decline to provide Ride Services based on factors that are not prohibited by law. For example, except where prohibited by law, GetWOBO Ridemates may decline Ride Services to Riders with pets, or to Riders who smoke.</li>\n' +
                '<li>Require Riders to respect restrictions on foods consumed in the vehicle (e.g., a Ridemates who maintains a Kosher or vegetarian kitchen may require Riders to respect those restrictions).</li>\n' +
                '<li>Nothing in this policy prevents a Ridemates from turning down a guest on the basis of a characteristic that is not protected under the civil rights laws or closely associated with a protected class. For example, a GetWOBO Ridemates may turn down a guest who wants to smoke in their vehicle, or place limits on the number of Riders in their vehicle.</li>\n' +
                '\n' +
                '</ol>\n' +
                '</li>\n' +
                '</ol>';
            $('#content').html(two);
        });
        $('#three').on('click',function (e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, 500);
            current = 3;
            three = '<p><b>When Riders are turned down.</b> Ridemates should keep in mind that no one likes to be turned down. While a Ridemates may have, and articulate, lawful and legitimate reasons for turning down a potential Rider, it may cause that member of our community to feel unwelcome or excluded. Ridemates should make every effort to be welcoming to Riders of all backgrounds. Ridemates who demonstrate a pattern of rejecting Riders from a protected class (even while articulating legitimate reasons), undermine the strength of our community by making potential Riders feel unwelcome, and GetWOBO may suspend Ridemates who have demonstrated such a pattern from the GetWOBO platform.</p>\n' +
                '<p> <b>What happens when a Ridemates does not comply with our policies in this area?</b> </p>\n' +
                '<p> If a particular Ride Service contains language contrary to this nondiscrimination policy, the Ridemates will be asked to remove the language and affirm his or her understanding and intent to comply with this policy and its underlying principles. GetWOBO may also, in its discretion, take steps up to and including suspending the Ridemates from the GetWOBO platform.</p>\n' +
                '<p>If the Ridemates improperly rejects Riders on the basis of protected class, or uses language demonstrating that his or her actions were motivated by factors prohibited by this policy, GetWOBO will take steps to enforce this policy, up to and including suspending the Ridemates from the platform.</p>\n' +
                '<p>As the GetWOBO community grows, we will continue to ensure that GetWOBO’s policies and practices align with our most important goal: To ensure that Riders and Ridemates feel welcome and respected in all of their interactions using the GetWOBO platform. The public, our community, and we ourselves, expect no less than this.</p>\n';
            $('#content').html(three);
        });
    });
</script>