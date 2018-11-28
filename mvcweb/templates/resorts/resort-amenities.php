<?php
	$pageType = "Amenities";
	$bookingHeader = "Amenities Overview";
  $bookingParagraph = $context->xpath('//ResortFeatures/resortFeatureSummary')[0];	
	$carouselImages = array();
	$images = $context->xpath('Resort/resort_imagery/image[section="Amenities"]');
	foreach($images as $image) {
		$carouselImages[] = (object)(array(
			'imgPath' => $image->image,
			'imgAltTag' => $bookingHeader . " " . $image->caption . ". Images of resort amenities.",
			'imgCaption' => $image->caption,
		));
	}
	include(dirname(__DIR__) . '/partials/resort.php');
?>

	<div class='container amenities-list-container'>
		<h3 class='amenities-list-header header-underline'>
			Amenities List
		</h3>
		<div class='container-fluid amenities-list-content d-block d-sm-block d-md-none d-lg-none d-xl-none'>
			<div class='row'>
				<?php
				foreach($context->xpath('//ResortFeaturesOptions') as $feature) {
					if(!emptyOrNull((string)$feature->featureTabTitle)) {
					echo resortAmenitiesItemDescriptionTemplate(
						new ResortIconContent(
							array(
								"imgSrc" => "activities-icons/" . strtolower(preg_replace('/[\s|&]+/', '', $feature->featureTabTitle)) . ".svg?=v1.1",
								"imgAlt" => $feature->featureTabTitle . " Feature",
								"imgText" => $feature->featureTabTitle,
								"contentBody" => $feature->featureTabDescription,
								"iconID" => strtolower(preg_replace('/[\s|&]+/', '', $feature->featureTabTitle)),
							)
						)
					);
				}
				}
			?>
			</div>
		</div>
		<div class='container-fluid features-section amenities-list-content d-none d-md-block d-lg-block d-xl-block' id='features-section'
		  style='display: none;'>
			<div class='features-content'>
				<div class='features-container'>
					<?php
						foreach($context->xpath('//ResortFeaturesOptions') as $feature) {
							if(!emptyOrNull((string)$feature->featureTabTitle)) {
							echo resortOverviewFeatureIconTemplate(
								new ResortIconContent(
									array(
										"imgSrc" => "activities-icons/" . strtolower(preg_replace('/[\s|&]+/', '', $feature->featureTabTitle)) . ".svg?=v1.1",
										"imgAlt" => $feature->featureTabTitle . " Feature",
										"imgText" => $feature->featureTabTitle,
										"contentHeader" => $feature->featureTabTitle,
										"contentBody" => $feature->featureTabDescription,
										"iconID" => strtolower(preg_replace('/[\s|&]+/', '', $feature->featureTabTitle)),
									)
								)
							);
						}
						}
					?>
				</div>
			</div>
		</div>
		<div class='container-fluid amenities-detail' id='amenitiesDetail' style='display: none;'>
			<h3 class='resort-icon-description-item-header'></h3>
			<div class='amenities-detail-content'>
			</div>
		</div>
	</div>
	<?php
		$path = rtrim($_SERVER['REQUEST_URI'],'/');
		$urlArray = explode('/',$path);
		$page = end($urlArray);
	?>
	<script language="javascript">
		var forceShowCaption = true;
		var found = false;
		var hasAnchored = false;
		$(function () {
			function itemHeaderClicked(e) {
				var that = $(this);
				var others = $('.resort-icon-description-item').filter(
					function(index, element) {
						return !($(element).is(that));
				});
				others.find('.amenities-item-header').removeClass('amenities-item-header-up');
				others.each(function() {
					$(this).find('.amenities-item-header').next().slideUp();
				});
				$(this).find('.amenities-item-header').toggleClass('amenities-item-header-up');
				$(this).find('.amenities-item-header').next().slideToggle(300);
			}
			function featureItemClicked(e) {
				$('.features-item').removeClass('selected');
					$(this).addClass('selected');
				var amenityHeader = $(this).attr('data-amenity-header');
				var amenityContent = $(this).attr('data-amenity-content');
				if (hasAnchored)
					$.scrollToElement('#amenitiesDetail', 800, -150);
				
				$('#amenitiesDetail')
					.fadeOut(300, function () {
						$(this).fadeIn().find('.amenities-detail-content').html(amenityContent);
						$(this).find('.resort-icon-description-item-header')
							.html(amenityHeader);
						
					});
			}
			$('.resort-icon-description-item').click(itemHeaderClicked);
			$('.features-item').click(featureItemClicked);
			var desktopAmenities = $('.features-item');
			var mobileAmenities = $('.resort-icon-description-item');
			var currUrl = window.location.href;
			function checkAmenity(index, element) {
				var elementId = $(element).attr('id');
				if (!found && currUrl.indexOf('#'+elementId) !== -1) {
					found = true;
					setTimeout(function() {
						$(window).scrollTop($(element).offset().top);
						element.click();
						hasAnchored = true;
					}, 1000);
				}
			}
			desktopAmenities.filter(':visible').each(checkAmenity);
			mobileAmenities.filter(':visible').each(checkAmenity);
			if (!found) {
				desktopAmenities.filter(':visible').first().click();
				mobileAmenities.filter(':visible').first().click();	
			}
		});
	</script>
	<?php
	echo horizontalBreak();
	include(dirname(__DIR__) . '/partials/resort-scripts.php');
?>
