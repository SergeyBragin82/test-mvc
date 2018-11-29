<?php
	$bookingHeader = checkForSpecialMarks(html_entity_decode(str_replace(array("<sup>", "</sup>"), "", $context->xpath('//name')[0])), 'trademark');
	$bookingParagraph = $context->xpath('//intro')[0];
	$resortCode = (string)$context->xpath('Resort/code')[0];
	$carouselImages = array();
	$images = $context->xpath('Resort/resort_imagery/image');
	foreach($images as $image) {
		$carouselImages[] = (object)(array(
			'imgPath' => $image->image,
			'imgAltTag' => $bookingHeader . " " . $image->caption . ". " . $bookingHeader . " is located in " . $context->xpath("Resort/ResortAddress/city")[0] . ", " . $context->xpath("Resort/ResortAddress/state")[0] . " " . $context->xpath("Resort/ResortAddress/country")[0] . ".",
			'imgCaption' => $image->caption
		));
	}
	$pageType = 'Overview';
	include(dirname(__DIR__) . '/partials/resort.php');
	// Disabling trip advisor for Empire Place
	if ($resortCode !== 'BK') {
		$tc = $context->xpath('//TripAdvisor/@TC');
		$coe = $context->xpath('//TripAdvisor/@COE');
		$ta_img_src = [];
		if ($tc) {
			$ta_img_src[] = getImageTag('tripadvisor/TA_TC_'.$tc[0][0].'.svg', 'TripAdvisor Traveler Choice', ['ta-img-item'], TRUE);
		}
		if ($coe) {
			$ta_img_src[] = getImageTag('tripadvisor/TA_COE_'.$coe[0][0].'.svg', 'TripAdvisor Certificate of Excellence', ['ta-img-item'], TRUE);
		}
		if(count($ta_img_src) > 0) {
			$taContainer = "<div class='ta-img-container'>";
			foreach($ta_img_src as $ta_img) {
				$taContainer .= $ta_img;
			}
			$taContainer .= '</div>';
			echo $taContainer;
		}
	}
	
	$permalink = $context->xpath('/mvcweb/Resort/permalink')[0];
?>

	<div class='container features-section' id='features-section' style='display: none;'>
		<h3 class='features-title'>Resort Amenities and Area Activities</h3>
		<div class='features-content'>
			<div class='features-container'>
				<a id='beach' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/beach.svg', 'beach feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>beach</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='diningbars' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/diningbars.svg', 'dining feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>dining &amp;
									<br>bars</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='exerciserecreation' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/exerciserecreation.svg', 'recreation feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>exercise &amp;
									<br>recreation</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='golf' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/golf.svg', 'golf feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>golf</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='marketplace' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/marketplace.svg', 'marketplace feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>marketplace</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='services' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/services.svg', 'services feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>services</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='shopping' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/shopping.svg', 'shopping feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>shopping</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='ski' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/ski.svg', 'ski feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>ski</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='spa' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/spa.svg', 'spa feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>spa</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='themepark' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/themepark.svg', 'theme park feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>theme park</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='urban' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/urban.svg', 'urban feature', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>urban</h4>
							</div>
						</div>
					</div>
				</a>
				<a id='featuredactivities' href='javascript:void(0);'>
					<div class='features-item disabled'>
						<div class='feature-icon'>
							<div class='feature-icon-content'>
								<div class='feature-icon-img'>
									<?php echo getImageTag('activities-icons/featuredactivities.svg?v=1.1', 'featured activities', NULL, TRUE); ?>
								</div>
								<h4 class='feature-icon-text'>featured activities</h4>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

	<!-- Resorts Overview Masonry Container -->
	<?php 
	echo vacationGreatnessIntro();
	// disabling olapic in overview for Empire Place Resort
	if ($resortCode !== 'BK') {
?>
	<div class="container-fluid">
		<div id="olapic_specific_widget" class='olapic-container'></div>
		<script type="text/javascript" src="https://photorankstatics-a.akamaihd.net/81b03e40475846d5883661ff57b34ece/static/frontend/latest/build.min.js"
		  data-olapic="olapic_specific_widget" data-instance="cfa121f9bf80495e3998017af1dc9cd7" data-apikey="6e7d38d5c66a82548e2717a92d97523bb6c3b7c932fc75b532ea8425762c84a7"
		  data-tags="<?php echo $context->xpath('//Olapic')[0]->olapicWorkstreamProductID; ?>" async="async"></script>
	</div>
	<?php
	} else {
		echo horizontalBreak();
	}
	include(dirname(__DIR__) . '/partials/resort-scripts.php');

	$path = rtrim($_SERVER['REQUEST_URI'],'/');
	$urlArray = explode('/',$path);
	$page = end($urlArray);
?>
		<script>
			$(function () {
				$('#bookingInfo').find('.title-text').before(
					$('<h3>')
					.addClass('header-text')
					.html('Welcome To')
				);
				$('.features-item').on({
					touchstart: function() {
						$(this).addClass('selected');
					},
					touchend: function() {
						var $obj = $(this);
						setTimeout(function() {
							$obj.removeClass('selected');
						}, 100);
					}
				});
				$('#features-section').insertAfter($('.resort-booking-container')).fadeIn();
				var interestsData = "<?php 
					$activities = [];
					foreach($context->xpath('//ResortFeaturesOptions') as $feature) {
						$activities[] = strtolower(preg_replace('/[\s|&]+/', '', $feature->featureTabTitle));
					}
					echo implode(',', $activities);
					?>".split(',').forEach(
					function (interest) {
						var toFind = interest.toLowerCase().trim().replace('_', '');
						var possibleNode = $('#' + toFind);
						if (possibleNode && possibleNode.length > 0) {
							possibleNode.attr('href', <?php echo json_encode("./amenities"); ?>);
							possibleNode.attr('href', possibleNode.attr('href') + '#' + toFind);
							possibleNode.find('.features-item').removeClass('disabled');
						}
					});
			});
		</script>
