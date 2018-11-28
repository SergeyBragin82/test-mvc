<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$interests = $context->xpath('//Interest');
$resorts = $context->xpath('//Resort');
$heroTitle = "Luxury Hotels & Residences";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "Some of the world’s most memorable hotels in its most magnificent cities: these add up to one amazing vacation. Exclusive packages include 47 Park Street– Grand Residences by Marriott<sup>®</sup>, Ritz-Carlton<sup>®</sup> hotels and more. Make one of them your home base for your next grand getaway."
	))
);
echo heroElementTemplate($heroTitle, "explorer-collection/luxury-hero.jpg", "View  the Empire State Building in New York City from the Top of the Strand. ", $heroContent, 'image-120');

$alttags = [
	'Pool view of The Lodge at Sonoma Renaissance Resort and Spa. ',
	'Harbour view of the Sydney Harbour Marriott Hotel at Circular Quay in Australia. ',
	'View from the west coast of Florida at the The Ritz-Carlton, Naples and beach. ',
	'Looking down at the pool and beach at the JW Marriott Cancun Resort and Spa. ',
	'Aerial view of the Renaissance Tuscany il Ciocco Resort and Spa. ',
	'Bay view of a fountain in front of The Ritz-Carlton in Millenia Singapore. ',
];

echo destinationPageContent("Hotels and Luxury Residences", "Below is just a taste of the extraordinary hotels and residences ready to greet you as an Owner.", $context->xpath("//Experience"), $alttags);
echo horizontalBreak(); ?>