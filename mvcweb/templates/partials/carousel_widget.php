<?php
function carouselCenterScreen(array $images = NULL, $localAssets = FALSE, array $tripAdvisor = NULL) {
	if (emptyOrNull($images)) {
		return;
	}
	$carouselHTML = "<div class='carousel-center' id='carousel-center' data-slideout-ignore style='display: none;'>\n";
	foreach($images as $key=>$value) {
		$carouselHTML .= "<div class='slick-slide slide-overlay'>"
		. getImageTagCarouselLazy($value->imgPath, $value->imgAltTag, NULL, $localAssets) . "<div class='gallery-caption'>".$value->imgCaption."</div></div>";
	}
	$carouselHTML .= "\n</div>";
	return $carouselHTML;
}
?>
