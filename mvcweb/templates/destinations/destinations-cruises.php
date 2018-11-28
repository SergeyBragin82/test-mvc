<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$interests = $context->xpath('//Interest');
$resorts = $context->xpath('//Resort');
$heroTitle = "Cruises";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "Life is simply better near the ocean. And when you’re on a cruise, it’s just about as good as it can be.  Relax and recharge with cruise options ranging from 2 nights to several weeks. As an Owner, you have access to ports of call around the world on a wide variety of cruise lines."
	))
);
echo '<div class="container-fluid hero-element destination-cruises">
			<div class="row">
				<div class="col-xl-4">
					<div class="hero-element-info">
						<h1 class="hero-element-info-header">
							Cruises
						</h1>
						<div class="break">
							<hr>
						</div>
						<div class="hero-element-info-body">
							<p>Life is simply better near the ocean. And when you’re on a cruise, it’s just about as good as it can be. Relax and recharge with cruise options ranging from 2 nights to several weeks. As an Owner, you have access to ports of call around the world on a wide variety of cruise lines.</p>
						</div>
					</div>
				</div>
				<div class="col-xl-8 cover-picture-container">
					<img class="content image-100" src="https://s23039.pcdn.co/wp-content/images/explorer-collection/cruises-hero.jpg" alt="View of a cruise ship overlooking an island. ">
				
				</div>
			</div>
		</div>';
$alttags = [
	'Deck view with tables and bicycles on MSC\'s 7-day Caribbean cruise ',
	'Pool view from a 15-day Panama Canal vacation by Princess Cruises. ',
	'View of the pool behind a statue on a 15 day Princess Cruiseship. ',
	'Inside view of a Royal Caribbean Cruiseship.  Take a 7 Night cruise in the Caribbean. ',
	'Inside view on board a 14-day Alaskan Princess Cruise vacation. ',
	'A poolside view on a beautiful day. Part of the Holland America Cruiseline 14 day cruise. ',
];

echo destinationPageContent("Cruises", "Below is just a taste of the countless cruises available to Owners seeking adventure and relaxation on the high seas.", $context->xpath('//Experience'), $alttags);
echo horizontalBreak(); 
 ?>
