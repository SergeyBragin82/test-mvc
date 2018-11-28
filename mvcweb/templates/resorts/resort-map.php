<?php
	include(dirname(__DIR__) . '/api/weather.php');
	include(dirname(__DIR__) . '/partials/resort-common.php');
	require_once(dirname(__DIR__) . '/classes/resort_icon_content_item.php');
	$pageType = "Map";
	$resort = $context->Resort[0];
	$externalCodes = $resort->ExternalCodesCollection->ExternalCodes[0];
	$transportInfo = $resort->xpath('//MVWCTransportInfo')[0];
	$resortHeader = checkForSpecialMarks(html_entity_decode(str_replace(array("<sup>", "</sup>"), "", $resort->name)), 'trademark-medium');
	$hasResortMap = $resort->xpath('//resort_imagery/hasResortMap')[0];
	$resortAddress = implode(
		array_filter(array(
			0 => (string)$resort->ResortAddress->street1, 
			1 => (string)$resort->ResortAddress->street2,
			2 => (string)$resort->ResortAddress->city,
			3 => (string)$resort->ResortAddress->state,
			4 => (string)$resort->ResortAddress->postalCode,
			5 => (string)$resort->ResortAddress->country
		)), ', ');
	// Weather
	$weatherApiUrl = $externalCodes->weatherUndergroundCode;
	$weatherData = getWeatherData($weatherApiUrl);
	$temperatureForecast = 88;
	if ($weatherData) {
		$temperatureForecast = $weatherData['current_observation']['temp_f'];
	}
	
	if ($context->xpath("//template/@ebrochure_mode")[0]=="true") {
		echo resortHeader($resortHeader, $temperatureForecast, $context);
	} else {
		echo horizontalBreak();
		echo resortHeader($resortHeader, $temperatureForecast, $context);
	}

?>
	<div class='resort-map-container'>
		<iframe frameborder="0" style="border: 0;" id='map' class='map-frame'></iframe>
	</div>
	<div class='transportation'>
		<h1 class='transportation-header'>
			<?php echo $context->xpath('/mvcweb/Resort/MapAndTransportationCollection/MapAndTransportation')[0]->title ?>
		</h1>
		<div class='transportation-header-info'>
			<?php  echo $context->xpath('/mvcweb/Resort/MapAndTransportationCollection/MapAndTransportation')[0]->drivingDirectionIntroText ?>
		</div>
	</div>
	<div class='transportation-info'>
		<?php
			$elements = array(
				0 => new ResortIconContent(
					array(
						"imgSrc" => "direction-icons/phone.svg",
						"imgAlt" => "Phone info",
						"imgText" => "resort phone",
						"contentHeader" => $resortHeader,
						"contentBody" => 
						"<ul class='resort-icon-description-item-list'>
						<li><span class='text'>" . $resortAddress . "</span></li>
						<li><span class='text'>" . "Main: " . phoneNumberTemplate($resort->ResortAddress->phone) . "</span></li>
						<li><span class='text'>" . "Fax: " . $resort->ResortAddress->fax . "</span></li></ul>"
					)
				),
				1 => new ResortIconContent(
					array(
						"imgSrc" => "direction-icons/airport.svg",
						"imgAlt" => "Airport info",
						"imgText" => "Airports &amp; directions",
						"contentHeader" => $resort->xpath('//MVWCTransportInfo/AirportsCollection/Airports/airportName')[0],
						"contentBody" => "<p>". $resort->xpath('//MVWCTransportInfo/AirportsCollection/Airports/drivingDirection')[0] . "</p>"
					)
				),
				2 => new ResortIconContent(
					array(
						"imgSrc" => "direction-icons/taxi.svg",
						"imgAlt" => "Fare info",
						"imgText" => "taxi fare",
						"contentHeader" => "estimated fare",
						"contentBody" => $resort->xpath('//MVWCTransportInfo/transportHelpInfo')[0]
					)
				),
				3 => new ResortIconContent(
					array(
						"imgSrc" => "direction-icons/parking.svg",
						"imgAlt" => "parking info",
						"imgText" => "parking",
						"contentHeader" => "parking info",
						"contentBody" => $resort->xpath('//MVWCTransportInfo/parkingInfo')[0]
					)
				)
			);
			echo resortFeatureContent($elements);
		?>
	</div>

	<?php
	echo horizontalBreak();

	include(dirname(__DIR__) . '/partials/resort-scripts.php');

	$path = rtrim($_SERVER['REQUEST_URI'],'/');
	$urlArray = explode('/',$path);
	$page = end($urlArray);
?>
			<script>
				var googleMap = $('#map');
				var mapContainer = $('.resort-map-container');

				googleMap.attr('src',
					"<?php echo $context->xpath('/mvcweb/Resort/MapAndTransportationCollection/MapAndTransportation')[0]->termsAndPrivacyDisclaimerText ?>"
				);

				var hasResortMap = "<?php echo $hasResortMap;?>" === 'true';
				if (hasResortMap) {
					var resortMap =
						$('<div>')
						.addClass('resort-map-image')
						.attr({
							style: 'display: none;',
						})
						.height(googleMap.height())
						.append(
							$('<img>')
							.addClass('img-fluid')
							.attr({
								src: '<?php echo $GLOBALS["img_path"] . "resortmaps/" . $resort->code . "_Map.jpg";?>'
							})
						);
					var resortMapBtn =
						$('<button>')
						.addClass('marriott-btn resort-map-button')
						.html('resort map')
						.click(function (e) {
							e.preventDefault();
							var btn = $(this);
							if (googleMap.is(':visible')) {
								btn.fadeOut(400, function () {
									$(this).html('google map');
									$(this).fadeIn();
								})
								googleMap.fadeOut(400, function () {
									resortMap.fadeIn();
								});
							} else {
								btn.fadeOut(400, function () {
									$(this).html('resort map');
									$(this).fadeIn();
								})
								resortMap.fadeOut(400, function () {
									resortMapBtn.html('resort map');
									googleMap.fadeIn();
								});
							}
						});
					mapContainer.append(resortMap, resortMapBtn);
				}
			</script>
