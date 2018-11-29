<?php
    function setMetas($path, $context) {
        $title = "title";
        $description = "description";
        $keywords = "keywords";

        if($context && count($context->xpath('Resort/marshaHotelCode')) > 0) {
            // We have a resort page! 
            $resort = $context->Resort[0];
            $rName = (string)$resort->name;
            $rCity = (string)$resort->city;
            $rState = (string)$resort->state;
            $rCountry = (string)$resort->country;
            
            // Check which tab
            if(0 < strpos($path, 'accommodations')) {
                $title = 'Accommodations';
                if( $rName ) { $title .= " | " . $rName; }
                if( $rCity ) { $title .= " | " . $rCity . " Resort"; }
                if( $rState ) { $title .= ', ' . $rState; }
                if( $rCountry ) { $title .= ', ' . $rCountry; }

                if($rName) {
                    $description = $rName." timeshare resort accommodations. ";
                } else {
                    $description = 'Timeshare resort accommodations. ';
                }
                $description .= "View villa room descriptions and options.";

                $keywords = "villa, accommodations";
                if( $rName ) { $keywords .= ', ' . $rName; }
                if( $rCity || $rState || $rCountry ) { $keywords .= ', '; }
                if( $rCity ) { $keywords .= $rCity . " vacation, " . $rCity . " resort"; }
                if( $rCity && ($rState || $rCountry) ) { $keywords .= ', '; }
                if( $rState || $rCountry ) { $keywords .= ', '; }
                if( $rState ) { $keywords .= $rState; }
                if( $rCountry ) { $keywords .= ", " . $rCountry; }
            } else if(0 < strpos($path, 'amenities')) {
                $title = 'Amenities';

                if( $rName ) { $title .= ' | ' . $rName; }

                if($rName) {
                    $description = "View " . $rName. " resort amenities. ";
                } else {
                    $description = 'View resort amenities. ';
                }
                if($rCity) {
                    $description .= "Your family's " . $rCity. " vacation starts here. ";
                } else {
                    $description .= "Your family's vacation starts here.";
                }

                $keywords = 'vacation, activities, things to do';
                if( $rName ) { $keywords .= ", " . $rName; }
                if( $rCity ) { $keywords .= ", " . $rCity . " vacation"; }
                if( $rState ) { $keywords .= ', ' . $rState; }

            } else if(0 < strpos($path, 'activities')) {
            
                $title = 'Activities';

                if($rName) { $title .= ' | ' . $rName; }

                if($rCity) {
                    $description = "Discover exciting things to do in ".$rCity.".";
                    $keywords = $rCity . " vacation, activities, things to do in "  . $rCity;
                } else {
                    $description = "Discover exciting things to do.";
                    $keywords = "vacation, activities, things to do";
                }
                if($rState) {
                    $description .= " There's a variety of activities to make the most of your ".$rState." vacation.";
                } else {
                    $description .= " There's a variety of activities to make the most of your vacation.";
                }
            
            } else if(0 < strpos($path, 'map')) {
            
                $title = 'Map';

                if( $rName ) { $title .= ' | ' . $rName; }
                
                // [Resort Name] maps and transportation. Enjoy all that [City] has to offer.
                $description = "maps and transportation.";

                if( $rName ) {
                    $description = $rName . " maps and transportation. ";
                } else {
                    $description = "Maps and transportation.";
                }

                if($rCity) {
                    $title .= ' | ' . $rCity . ' Resort';
                    $description .= " Enjoy all that " . $rCity . " has to offer.";
                    $keywords = $rCity . " map, map of "  . $rCity;
                } else {
                    $keywords = "map";
                }
            
            } else {

                $title = 'Resort Overview';
                
                if( $rName ) { $title .= ' | ' . $rName; }
                
                if($rName) {
                    $description = $rName." timeshare resort overview. ";
                } else {
                    $description = 'Timeshare resort overview. ';
                }
                if($rCity) { $description .= " Enjoy all that ".$rCity." has to offer."; }
                $description .= ' Book your vacation today.';

                $keywords = "timeshare resort";
                if( $rName || $rCity || $rState || $rCountry ) { $keywords .= ', '; }
                if( $rName ) { $keywords .= $rName; }
                if( $rName && ($rCity || $rState || $rCountry) ) { $keywords .= ', '; }
                if( $rCity ) { $keywords .= $rCity . " vacation, " . $rCity . " timeshare"; }
                if( $rCity && ($rState || $rCountry) ) { $keywords .= ', '; }
                if( $rState || $rCountry ) { $keywords .= ', '; }
                if( $rState ) { $keywords .= $rState; }
                if( ($rName || $rCity || $rState) && $rCountry ) { $keywords .= ", " . $rCountry; }
            }

            if( $rCity ) { $title .= " | " . $rCity . " Resort"; }
            if( $rState || $rCountry ) { $title .= ', '; }
            if( $rState ) { $title .= $rState; }

        } else {
            // We do not have a resort
            switch ( $path ) {
                case "/":
                    $title = "Marriott Vacation Club® Official Site";
                    $description = "Explore Marriott timeshare ownership, see how it works, and view timeshare specials.  Choose exciting vacations, with over 50 Marriott Vacation Club resorts in 7 countries.";
                    $keywords = "marriott timeshare, timeshare ownership, vacation ownership, marriott vacation club";
                   break;

                case "/timeshare-ownership/about/":
                    $title = "Why Timeshare Ownership? | Marriott Vacation Club® Official Site";
                    $description = "Over 9 million US households own a timeshare product. Discover the benefits of timeshare ownership and what sets Marriott Vacation Club apart.";
                    $keywords = "timeshare, marriott timeshare, vacation ownership, timeshare resorts, marriott vacation club";
                    break;

                case "/timeshare-ownership/about-marriott-vacation-club/":
                    $title = "Why Marriott Vacation Club | Marriott Vacation Club® Official Site";
                    $description = "See what makes Marriott Vacation Club special. Get access to Marriott Vacation Club destinations around the world, guided tours, Marriott hotels, and cruises. Choose any resort, any villa, any size, any check-in day and any length of stay.";
                    $keywords = "marriott vacation club, timeshare, timeshare resorts, hotels";
                    break;

                case "/timeshare-ownership/how-it-works/":
                    $title = "How It Works | Marriott Vacation Club® Official Site";
                    $description = "Learn how Marriott Vacation Club Points work from accommodation size, length of stay, location and season. Bank or borrow Points and add more at any time.";
                    $keywords = "marriott vacation club, vacation club points, timeshare points, rewards";
                    break;

                case "/timeshare-ownership/get-started/":
                    $title = "How to Become an Owner | Marriott Vacation Club® Official Site";
                    $description = "Become a Marriott Vacation Club Owner in 3 easy steps. Buying deeded timeshare has never been easier, let us help you find a fun vacation plan that fits your travel needs.";
                    $keywords = "vacation plan, timeshare ownership, marriott vacation club owner";
                    break;

                case "/destinations/":
                    $title = "Explore Resort Destinations | Marriott Vacation Club® Official Site";
                    $description = "Access thousands of hotels and resorts in amazing destinations around the world with the Marriott Vacation Club vacation collections.";
                    $keywords = "family vacation, vacation destinations";
                    break;

                case "/destinations/marriott-vacationclub-club-resorts/":
                    $title = "Marriott Vacation Club Resorts | Marriott Vacation Club® Official Site";
                    $description = "Explore more than 50 spectacular resorts.  Spacious family vacation villas in some of the world's most desired destinations.";
                    $keywords = "vacation resorts, timeshare resorts";
                    break;

                case "/destinations/marriott-rewards/":
                    $title = "Marriott Rewards Hotel Choices | Marriott Vacation Club® Official Site";
                    $description = "Enjoy the freedom to choose from more than 4,000 great hotels around the globe. Marriott Hotels & Resorts, JW Marriott, Renaissance, Ritz-Carlton, Courtyard, and other Marriott hotel brands.";
                    $keywords = "marriott rewards, marriott hotels, marriott resorts";
                    break;

                case "/destinations/exchange-partner-resorts/":
                    $title = "Exchange Partner Resorts | Interval International | Marriott Vacation Club® Official Site";
                    $description = "Choose from more than 3,000 affiliate resorts in over 80 nations. Everything from an oceanfront palace in Rio de Janeiro to a 13th-century stone abbey in Ireland. From Cancun to Cabo San Lucas, St. Maarten to Sedona, Beijing to Buenos Aires. ";
                    $keywords = "vacation resorts, travel";
                    break;

                case "/destinations/explorer-collection/":
                    $title = "Explorer Collection | Marriott Vacation Club® Official Site";
                    $description = "Spectacular travel packages and vacation memories. Adventure and specialty travel including African safaris, wine tours, and cruises. Visit the Great Wall of China, Rome, Greek Isles, Alaskan coast, Caribbean and more.";
                    $keywords = "travel, hotels, cruises, vacation homes, vacation packages";
                    break;

                case "/destinations/cruises/":
                    $title = "Cruises | Marriott Vacation Club® Official Site";
                    $description = "Explore countless ports around the world including Alaska, Holland, Italy, and Panama.  You have access to a hundreds of cruise lines like Royal Caribbean, Viking, Celebrity and Carnival.";
                    $keywords = "cruises, cruise lines, ports of call, ocean cruise";
                    break;

                case "/destinations/guided-tours/":
                    $title = "Guided Tours | Marriott Vacation Club® Official Site";
                    $description = "Guided tours can provides you with professionally planned itineraries and personal time for your own adventures. Explore Europe, Iceland, Tuscany, Ireland and many more destinations.";
                    $keywords = "guided tours, planned itinerary, itinerary planning, bucket list";
                    break;

                case "/destinations/vacation-homes/":
                    $title = "Vacation Homes | Marriott Vacation Club® Official Site";
                    $description = "Thousands of high-quality vacation homes chosen for you in destinations like Hilton Head, Cabo San Lucas, Italy, and Greece. Perfect for family reunions and special celebrations.";
                    $keywords = "vacation homes, vacation properties, luxury accommodations";
                    break;

                case "/destinations/adventure-travel/":
                    $title = "Adventure Travel | Marriott Vacation Club® Official Site";
                    $description = "Venture off the beaten path with thrilling travel adventures. For those that enjoy hiking, biking, rafting or multi-sport adventures.";
                    $keywords = "adventure travel, hiking, biking, rafting, multi-sport, adventures, excursions, off the beaten path";
                    break;

                case "/destinations/specialty-packages-activities/":
                    $title = "Specialty Packages & Activities | Marriott Vacation Club® Official Site";
                    $description = "Plan your vacation with prepackaged sports and entertainment options.  If you can dream it, we can help you live it.";
                    $keywords = "customized vacations, prepackaged vacations, vacation activities, specialty packages, specialty activities";
                    break;

                case "/destinations/hotels-and-luxury-residences/":
                    $title = "Luxury Hotels & Residences | Marriott Vacation Club® Official Site";
                    $description = "Exclusive packages make amazing vacations. Stay in the world's most memorable luxury hotels in its most magnificent cities.  ";
                    $keywords = "luxury hotels, residences, 47 park st, grand residences by marriott, ritz-carlton hotels, exclusive vacations";
                    break;

                case "/vacation-inspiration/":
                    $title = "Authentic Travel Tips for Better Vacations | Marriott Vacation Club® Official Site";
                    $description = "Read insightful travel tips and ideas for your next vacation.  Seasoned travelers share their firsthand experiences and advice.";
                    $keywords = "travel tips, travel advice, vacation tips, vacation advice, local experts, destination advice, destination tips";
                    break;

                case "/privacy":
                    $title = "Privacy Policy | Marriott Vacation Club® Official Site";
                    $description = "Marriott Vacation Club will not sell, lease, or rent your information.";
                    $keywords = "privacy policy";
                    break;

                case "/cookie-policy":
                    $title = "Cookie Privacy | Marriott Vacation Club® Official Site";
                    $description = "View a list of Marriott Vacation Club's cookies, purposes, and durations of these tracking pixels.";
                    $keywords = "cookie policy";
                    break;

                case "/state-and-legal-disclosures/":
                    $title = "State Disclosures | Marriott Vacation Club® Official Site";
                    $description = "List Marriott Vacation Club's state and legal disclosures.";
                    $keywords = "state and legal disclosures";
                    break;

                case "/terms-of-use/":
                    $title = "Terms of Use | Marriott Vacation Club® Official Site";
                    $description = "Marriott Vacation Club terms of use.";
                    $keywords = "terms of use";                
                case "/photo-and-video-terms-of-use/":
                    $title = "Photo and Video Terms of Use | Marriott Vacation Club® Official Site";
                    $description = "Marriott Vacation Club will not sell, lease, or rent your information.";
                    $keywords = "user generated content";
                    break;

                case "/newsroom/":
                    $title = "News | Marriott Vacation Club® Official Site";
                    $description = "Read the latest news from Marriott Vacation Club. Subscribe to receive our latest press releases and events.";
                    $keywords = "press releases, newsroom, media kit";
                    break;

                case "/contact-us/":
                    $title = "Contact Us | Marriott Vacation Club® Official Site";
                    $description = "General contact information including Marriott Vacation Club International's corporate address and phone numbers.";
                    $keywords = "contact us";
                    break;

                case "/careers/":
                    $title = "Careers | Marriott Vacation Club® Official Site";
                    $description = "Marriott Vacation Worldwide offers a range of enjoyable job opportunities. Search for your  next career and send us your resume.";
                    $keywords = "resume, job search, job opportunity, career";
                    break;

                case "/sitemap/":
                    $title = "Site Map | Marriott Vacation Club® Official Site";
                    $description = "Easily find pages within our site including resorts, specials, how Marriott timeshare works, and more. Contact us to learn more about Marriott timeshare ownership. ";
                    $keywords = "sitemap";
                    break;

                case "/request-information/":
                    $title = "Request Information | Marriott Vacation Club® Official Site";
                    $description = "Request vacation ownership information. Learn about Marriott timeshare vacations.";
                    $keywords = "contact us, request information";
                    break;

                case "/ilg-acquisition/":
                    $title = "ILG Acquisition | Marriott Vacation Club® Official Site";
                    $description = "Request vacation ownership information. Learn about Marriott timeshare vacations.";
                    $keywords = "contact us, request information";
                    break;
                    
                case "/owners/ilg-acquisition/":
                    $title = "ILG Acquisition for Owners | Marriott Vacation Club® Official Site";
                    $description = "Request vacation ownership information. Learn about Marriott timeshare vacations.";
                    $keywords = "contact us, request information";
                    break;
                    
                case "/faq/":
                    $title = "Frequently Asked Questions (FAQ) | Marriott Vacation Club® Official Site";
                    $description = "Get answers to frequently asked questions including: what is timeshare, how do timeshares work, how much do timeshares cost, how to buy a timeshare and more.";
                    $keywords = "frequently asked questions";
                    break;

                default:
                    $title = "Marriott Vacation Club® Official Site";
                    $description = "Explore Marriott timeshare ownership, see how it works, and view timeshare specials.  Choose exciting vacations, with over 50 Marriott Vacation Club resorts in 7 countries.";
                    $keywords = "marriott timeshare, timeshare ownership, vacation ownership, marriott vacation club";
                    break;
                }
        } // end switch
        return <<<HTML
    <title>$title</title>
    <meta name="description" content="$description">
    <meta name="keywords" content="$keywords">
HTML;
    }
?>