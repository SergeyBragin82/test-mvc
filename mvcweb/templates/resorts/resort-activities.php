<?php
	$pageType = "Activities";
	$resort = $context->Resort[0];
	$localActivitiesData = $resort->LocalActivitiesCollection->LocalActivities[0];
  $bookingHeader = $localActivitiesData->localActivitiesTitle;
	$bookingParagraph = $localActivitiesData->localActivitiesIntro;
	$carouselImages = array();
	$images = $context->xpath('Resort/resort_imagery/image[section="Activities"]');


	if (count($images) ===0 ) {
		$images = $context->xpath('Resort/resort_imagery/image');		
	}

	foreach($images as $image) {
		$carouselImages[] = (object)(array(
			'imgPath' => $image->image,
			'imgAltTag' => $bookingHeader . " " . $image->caption . ". Things to do in " . $context->xpath("Resort/ResortAddress/city")[0] . ".",
			'imgCaption' => $image->caption
		));
	}
	include(dirname(__DIR__) . '/partials/resort.php');
?>
<?php 
	$excluded_resorts = explode(",", get_option("MVC_CONFIG_EXCLUDED_ACTIVITIES_RESORTS"));
	if(!in_array($context->xpath("Resort/code")[0], $excluded_resorts)) {
?>
	<?php
	echo horizontalBreak();
	include(dirname(__DIR__) . '/activities/activities.php');

	//include(dirname(__DIR__) . '/partials/google_map.php');
	//include(dirname(__DIR__) . '/partials/yelp_console.php');
	}
	include(dirname(__DIR__) . '/partials/resort-scripts.php');
?>
