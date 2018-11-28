<?php
	include(dirname(__DIR__) . '/partials/resort-common.php');
	include(dirname(__DIR__) . '/partials/carousel_widget.php');
	include(dirname(__DIR__) . '/partials/booking_widget.php');
	include(dirname(__DIR__) . '/api/weather.php');
	//Resort info
	$resort = $context->Resort[0];
	$resortAddress = $resort->ResortAddress;
	$resortFeature = $resort->ResortFeatures;
	$externalCodes = $resort->ExternalCodesCollection->ExternalCodes[0];
	
	// Weather
	$weatherApiUrl = $externalCodes->weatherUndergroundCode;
	$weatherData = getWeatherData($weatherApiUrl);
	$temperatureForecast = 88;
	if ($weatherData) {
		$temperatureForecast = $weatherData['current_observation']['temp_f'];
	}
	$resortHeader = checkForSpecialMarks(html_entity_decode(str_replace(array("<sup>", "</sup>"), "", $resort->name)), 'trademark-medium');

	if ($context->xpath("//template/@ebrochure_mode")[0]=="true") {
		echo resortHeader($resortHeader, $temperatureForecast, $context);
	} else {
		echo resortHeader($resortHeader, $temperatureForecast, $context);
	}



	echo carouselCenterScreen($carouselImages, FALSE);
	$brandCode = (string)$context->xpath('Resort/Brands/code')[0];
	$marshaHotelCode = (string)$context->xpath('//marshaHotelCode')[0];
	$childResorts = $context->xpath('//ChildResort');
	$resortName = $context->xpath('//resortDisplayName')[0];

	echo resortBookingSection($brandCode, $marshaHotelCode, (string)$context->xpath('Resort/code')[0], $context->xpath('//disclaimer')[0], $bookingHeader, $bookingParagraph, '', '', '', $childResorts, $resortName, ($context->xpath("//@ebrochure_mode")[0]=="true"));

//	if ($context->xpath("//@ebrochure_mode")[0]!="true") {
//		echo tripAdvisorQuote();
//	}
	echo horizontalBreak();
?>
