<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$heroTitle = "Adventure Travel";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "Ready for a hands-on adventure? With one of these hiking, biking, rafting or multisport adventures, you can venture off the beaten path and experience your destination in an entirely different way: as a participant.

Explore the Greek Islands on a semi-private yacht, traverse the Amazon River, tour the Galapagos or Antarctica on an adventure cruise, or experience the thrill of the Colorado River on a rafting and camping excursion."
	))
);
echo heroElementTemplate($heroTitle, "explorer-collection/adventure-travel-hero.jpg", "Woman exploring a rocky river on an Adventure Travel experience. Create your own thrilling adventures. ", $heroContent, 'image-120');

$alttags = [
	'View of a Thailand long tail boat part of a 4 Day Thailand Sailing from Phuket to Koh Phi Phi. ',
	'Pair of hikers on a 15 Day Peru Multi-sport vacation package. ',
	'View of the Taj Mahal in Northern India, part of an 8-day package. ',
	'Traveler gazing out on a 7-day Amazon Riverboat adventure. ',
	'Couple admiring the scenery on their 8 Day Realm of the Polar Bear vacation package. ',
	'Glacier view of a 11 Day Antarctica vacation package. ',
];

echo destinationPageContent("Adventure Travel Experiences", "Here are just some of the amazing destinations and thrills available to Owners looking to vacation off the beaten path.", $context->xpath('//Experience'), $alttags);
echo horizontalBreak(); 
 ?>
