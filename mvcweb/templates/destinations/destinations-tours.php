<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$heroTitle = "Guided Tours";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "If you want the best of both worlds &mdash; a professionally planned itinerary and personal time for your own adventures &mdash; these expertly guided tours were designed with you in mind.
 
Choose from an ever-changing catalog of the world’s most fascinating excursions, and get ready to start checking items off your bucket list."
	))
);
echo heroElementTemplate($heroTitle, "explorer-collection/guided-tours-hero.jpg", "A scenic view on part of the Great Wall of China. Personally planned vacations help you make the most of your adventure. ", $heroContent, 'image-120');

$alttags = [
	'Visit Stonehendge on your Britain and Ireland vacation. ',
	'See a heard of elephants on the Plains of Africa in Kenya\'s wildlife safari. ',
	'View from Kaikoura, New Zealand\'s top of the South Island. ',
	'View from the mountains of Machu Picchu. ',
	'Gaze down into the magnificient Grand Canyon in Arizona. ',
	'Revel in the magic of Italy. View of the Rialto Bridge along the Grand Canal in Venice. ',
];

echo destinationPageContent("Guided Tours", "Below is just a small glimpse at the vast array of guided tours our Owners have access to.", $context->xpath('//Experience'), $alttags);
echo horizontalBreak(); 
 ?>
