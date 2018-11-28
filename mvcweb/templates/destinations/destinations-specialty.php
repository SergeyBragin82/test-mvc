<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$heroTitle = "Specialty Packages & Activities";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "With an exciting array of prepackaged weekends and vacation activities, the Explorer Collection of the Marriott Vacation Club Destinations Exchange Program allows you to customize your vacation. Whether it’s a 3-night hotel package in Latin America, expert golf instruction or access to premier entertainment and sporting events, we can help you live it."
	))
);
echo heroElementTemplate($heroTitle, "explorer-collection/specialty-packages-hero.jpg", "Golfer enjoying the game on a quiet golf course. Customize a specialty vacation package to match your interests. ", $heroContent, 'image-120');

$alttags = [
	'Michigan and Syracuse college basketball players face off in a NCAA game. ',
	'The Chicago Cubs celebrating their baseball World Series win. ',
	'Kentucky Derby race underway. Customize your own Kentucky Derby specialty package. ',
	'View of The Emmy Awards ceremony. An experience you can enjoy from the Mezzanine level. ',
	'Pittsburgh Penguin hockey player, Sidney Crosby hoisting the Stanley Cup.  Join the action. ',
	'Brad Paisley and Carrie Underwood at the Country Music Awards. Customize your own CMA specialty package. ',
];

echo destinationPageContent("Specialty Packages", "Here are just a few examples of the most popular Specialty Packages available to our Owners.", $context->xpath('//Experience'), $alttags);
echo horizontalBreak(); 
 ?>
