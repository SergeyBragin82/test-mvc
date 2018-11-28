<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$heroTitle = "Vacation Homes";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "Owners at the Executive&#42;, Presidential and Chairman’s Club benefit levels have access to upscale and distinctive vacation homes located in desirable destinations such as Cabo San Lucas, Croatia and Italy &mdash; perfect for hosting family reunions, anniversaries and other special celebrations."
	)),
	1 => new HeroContent(array(
		"contentParagraph" => "&#42;Vacation Home options differ by benefit level.",
		"contentClass" => "mt-4",
	)),
);
echo heroElementTemplate($heroTitle, "explorer-collection/vacation-homes-hero.jpg", "A magnificent pool view at a luxury vacation home overlooking the ocean. Over 2,000 vacation homes at your fingertips. ", $heroContent, 'image-120');

$alttags = [
	'Villa Paradise overlooking the bay of Eze in Cote D\'Azur & St. Tropez, France. ',
	'Aerial view of the VI Friendship Villa on the caribbean island of St. John, USVI. ',
	'Relax at The Villa Augusta Tuscany in Italy. ',
	'View of the pool and beach by the Casa La Laguna in Los Cabos, Baja California Sur, Mexico. ',
	'Ski in and out of Glacier Lodge in the heart of Blackcomb Upper Village in Whistler, Canada. ',
	'Stay in the Villa Punto de Vista\'s 10 bedroom villa in a perfect Coasta Rican retreat. ',
];

echo destinationPageContent("Vacation Homes", "Here’s just a small sample of the breathtaking vacation homes and destinations our Owners enjoy.", $context->xpath('//Experience'), $alttags);
echo horizontalBreak(); 
 ?>
