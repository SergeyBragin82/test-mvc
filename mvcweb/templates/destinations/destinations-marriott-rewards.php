<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$interests = $context->xpath('//Interest');
$resorts = $context->xpath('//Resort');
$heroTitle = "Around the World & Around the Corner";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "As an Owner, you can convert Vacation Club Points for Marriott Rewards<sup>®</sup><a class='general-info-link' href='/state-and-legal-disclosures#legal3'><sup>3</sup></a> points and take advantage of world-renowned Marriott hospitality and accommodations.

Whether you want a room for a short getaway or a suite in the heart of one of the world’s most exciting cities, the Marriott family of hotel brands offers ample options for your next vacation."
	))
);
echo heroElementTemplate($heroTitle, "rewards-hero.jpg", "Stylish pool with chefs and wine. Take advantage of Marriott&#39;s world-renowned accommodations and hospitality. ", $heroContent, 'image-120 222');
 ?>

 <div class='destinations-container'>
	 <h2 class='destinations-center-header'>
		 Exceptional Marriott<sup>&reg;</sup> Hotel Choices
	 </h2>
	 <p style='text-align: center;'>Below is a small sample of award-wining Marriott<sup>&reg;</sup> properties our Owners have access to when they trade their Vacation Club Points for Marriott Rewards points through the Marriott Vacation Club Destinations<sup>&reg;</sup> Exchange Program.
	 <div class='container-fluid resort-preview-container'>
		 <div class='row'>
		 	<?php 
		 		$alttags = [
					'Front entrance to the St. Ermin\'s Hotel in London, part of the Autograph Collection',
					'View overlooking Domes Noruz Chania hotel\'s pool and beach, part of the Autograph Collection. ',
					'Aerial view of the JW Marriott Guanacaste Resort & Spa in Coasta Rica. ',
					'Canal entrance view of the JW Marriott Venice Resort & Spa. ',
					'View of the amazing pool at the JW Marriott Hotel in Macau. ',
					'Outside view of The Inn at Opryland, a Gaylord Hotel. ',
		 		];
		 	?>
		 	<?php foreach ($context->xpath("//Experience") as $idx => $experience) {?>
			 <div class='col-lg-4'>
				 <?php echo destinationElementPreview($experience, $alttags[$idx]); ?>
			 </div>
			 <?php } ?>
		 </div>
	 </div>
 </div>
 <div class='container-fluid'>
	 <div class='rewards-icons-one'>
		 <?php echo getImageTag('rewardsIcons/marriottRewardIconsOneLine.svg', 'rewards logos', array(0=>'img-fluid'), true); ?>
		</div>
		 <div class='rewards-icons-two'>
		 <?php echo getImageTag('rewardsIcons/marriottRewardIconsTwoLine.svg', 'rewards logos', array(0=>'img-fluid'), true); ?>
		</div>
	 <div class='rewards-icons-three'>
		 <?php echo getImageTag('rewardsIcons/marriottRewardIconsThreeLine.svg', 'rewards logos', array(0=>'img-fluid'), true); ?>
		</div>
	 <div class='destinations-rewards-description'>
		<p>Marriott Executive Apartments is a proud earning partner with Marriott Rewards. Interested in learning more about the Marriott Rewards program, becoming a member, redeeming points, or any other benefits of the program? Visit <a class='general-info-link' href="javascript: void(0);" onclick='javascript:attachLegalPopupToExternalLinks("http://www.marriottrewards.com")'>MarriottRewards.com.</a>
	</p>
	 </div>
 </div>
 <?php echo horizontalBreak(); ?>
