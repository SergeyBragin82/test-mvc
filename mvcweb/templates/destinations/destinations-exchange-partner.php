<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$interests = $context->xpath('//Interest');
$resorts = $context->xpath('//Resort');
$heroTitle = "Expand Your Horizons";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "Broaden your travel options even further with thousands of resorts around the world through our external exchange partner, Interval International<sup>®</sup><a class='general-info-link' href='/state-and-legal-disclosures#legal5'/><sup>5</sup></a>. Cape Town in South Africa, the Red Sea in Egypt, the Andes Mountains in Venezuela, and the islands of Fiji are just a few of the exotic and exciting destinations available to you."
	))
);
echo heroElementTemplate($heroTitle, "partnerResortsHero.jpg", "View of pool balconies and beach at Generations Riviera Maya family resort near Cancun, Mexico. ", $heroContent);
 ?>

 <div class='destinations-container'>
	 <h2 class='destinations-center-header'>
		 Exchange Partner Resorts
	 </h2>
	 <p style='text-align: center;'>Below is just a small sampling of popular Interval International resorts our Owners enjoy.</p>
	 <div class='container-fluid resort-preview-container'>
		 <div class='row'>
		 	<?php
		 		$alttags = [
		 			'Pool view at Four Seasons Country Club within the Quinta do Lago resort complex in Portugal. ',
		 			'Inside lobby area at Embarc Whistler resort just off the slopes of Blackcomb Mountain in British Columbia, Canada. ',
		 			'A snowy view outside Yama Shizen resort properties in Hokkaido, Japan. ',
		 			'The Quarter House in New Orleans\' French Quarter. ',
		 			'Sunset aerial view of the Grand Luxxe at Nuevo Vallarta, Mexico. ',
		 			'Aerial view of the Harborside Resort at Atlantis Paradise Island. ',
		 		]
		 	?>
		 	<?php foreach ($context->xpath("//Experience") as $idx => $experience) {?>
			 <div class='col-md-4'>
				 <?php echo destinationElementPreview($experience, $alttags[$idx]); ?>
			 </div>
			 <?php } ?>
		 </div>
	 </div>
 </div>
 <?php echo horizontalBreak(); ?>
