<?php
	include(dirname(__FILE__) . '/partials/carousel_widget.php');

$classes = array(
	0 => 'text-center'
); 

$contentItem = array(
	0 => new ColumnItemContent(array(
		'imgPath' => 'beachfamily.jpg',
		'imgAlt' => 'A mother and daughter laughing on the beach standing in the water.  Find destinations and experiences that you can enjoy. ',
		'contentHeader' => 'Where Can I Go',
		'contentParagraph' => 'See Destinations & Experiences',
		'buttonText' => 'EXPLORE OPTIONS',
		'buttonHref' => '/destinations',
		'extraClasses' => $classes
	)),
	1 => new ColumnItemContent(array(
		'imgPath' => 'boatsail.jpg',
		'imgAlt' => 'Cruise ship on the water in the arctic. Luxury cruises from Antarctica to Alaska. ',
		'contentHeader' => 'The Wild Blue Yonder',
		'contentParagraph' => 'Luxury Cruises from Alaska to Antarctica',
		'buttonText' => 'READ MORE',
		'buttonHref' => '/destinations/cruises',
		'extraClasses' => $classes
	)),
	2 => new ColumnItemContent(array(
		'imgPath' => '201809/NewportCoastVillas02_690x520.jpg',
		'imgAlt' => 'View of the main pool at Marriott\'s Newport Coast Villas in Newport Coast, California.',
 		'contentHeader' => 'Special Offer',
		'contentParagraph' => 'Florida Beach Bonus Vacation Offer',
		'buttonText' => 'Learn More',
		'buttonHref' => '/request-information',
		'buttonID' => 'specialOfferHome',
		'extraClasses' => $classes
	)));
	$carouselItems = array(
		0 => (object)(array(
			'imgPath' => 'homepage-carousel/ILGMVC-oneCompany-centered.jpg',
			'imgOverlay' => 'homepage-carousel/OneCompany.png',
			'imgOverlayID' => 'oneCompany',
			'imgAlt' => 'One Company, A World of Vacations',
			'captionText2' => '<span style="font-size:16px; color:#fff;">A <strong>World</strong> of <strong>Amazing</strong> New Opportunities Awaits</span>',
			'buttonText' => 'Learn More >',
			'buttonHref' => '/ilg-acquisition/?cid=intrnl-mvc-ilg',
			'targetWindow' => '_blank'
		)),
		1 => (object)(array(
			'imgPath' => 'homepage-carousel/beach-family.jpg',
			'imgAlt' => 'Family on vacation walking together on a beach. Live the vacation lifestyle. Explore timeshare ownership. ',
			'captionText' => 'Live The<br> Vacation Lifestyle',
			'buttonText' => 'EXPLORE OWNERSHIP',
			'buttonHref' => '/timeshare-ownership/about-marriott-vacation-club#lifestyle-video'
		)),
		2 => (object)(array(
			'imgPath' => 'homepage-carousel/villa.jpg',
			'imgAlt' => 'Stylish living room with view of ski slopes. Spacious vacation villas. Experience the villa difference. ',
			'captionText' => 'Spacious<br>Vacation Villas',
			'buttonText' => 'experience the villa difference',
			'buttonHref' => '/timeshare-ownership/about-marriott-vacation-club#villa-difference'
		)),
		3 => (object)(array(
			'imgPath' => 'homepage-carousel/cruise.jpg',
			'imgAlt' => 'Cruise ship sailing away. Resorts, cruises, guided tours and more. See vacation options. ',
			'captionText' => 'Resorts, Cruises,<br>Guided Tours &amp; More',
			'buttonText' => 'See vacation options',
			'buttonHref' => '/destinations'
		)),
		4 => (object)(array(
			'imgPath' => 'homepage-carousel/vacation-homes.jpg',
			'imgAlt' => 'Evening shot of a beautiful vacation home from the pool.  Vacation homes. Find new places to call home. ',
			'captionText' => 'Vacation Homes',
			'buttonText' => 'find new places to call home',
			'buttonHref' => '/destinations/explorer-collection/vacation-homes/'
		)),
		5 => (object)(array(
			'imgPath' => 'homepage-carousel/paradise.jpg',
			'imgAlt' => 'View from a Hawaiian resort pool looking out towards the ocean. Your paradise in paradise. Discover Big Island, Hawaii. ',
			'captionText' => 'Your Paradise<br>in Paradise',
			'buttonText' => 'discover big island, hawaii',
			'buttonHref' => '/vacation-resorts/koamv-marriotts-waikoloa-ocean-club/'
		)),
	);

	function getCarouselElement($carouselItem) {
		$img =  getImageTagCarouselLazy($carouselItem->imgPath, $carouselItem->imgAlt, NULL, TRUE);
		$img2 = getImageOverlay($carouselItem->imgOverlay, $carouselItem->imgOverlayID);
		$targetWindow = $carouselItem->targetWindow;
		if( $targetWindow ) { $target .= 'target="' . $targetWindow . '"'; }
		return <<<HTML
			<div class='slick-slide'>
				<div class='slider-caption'>
					<h1 class='slider-caption-text'>
						$carouselItem->captionText
					</h1>
					<a class='btn' role='button' href='$carouselItem->buttonHref' $target style='background: $carouselItem->buttonColor'>$carouselItem->buttonText</a>
				</div>
					$img
			</div>
HTML;
	}
?>
	<div class='home-carousel-container' id='home-carousel-container' data-slideout-ignore>
		<?php
		foreach($carouselItems as $carouselItem) {
			echo getCarouselElement($carouselItem);
		}
	?>
	</div>
	<div class='content-container'>
		<div class='content-flavor-left'>
			<?php echo getImageTag('backgroundElements/TROP_Lt.png', '', NULL, TRUE); ?>
		</div>
		<div class='content-flavor-right'>
			<?php echo getImageTag('backgroundElements/TROP_Rt.png', '', NULL, TRUE); ?>
		</div>

		<div class="container body-content home-body-content">
			<?php echo columnListItemWithPicture($contentItem) ?>
		</div>
		<?php echo vacationGreatnessIntro(); ?>

		<div class="container-fluid" style="background-color: #f5f5f5;">
			<div id="olapic_specific_widget"></div>
			<script type="text/javascript" src="https://photorankstatics-a.akamaihd.net/81b03e40475846d5883661ff57b34ece/static/frontend/latest/build.min.js"
			  data-olapic="olapic_specific_widget" data-instance="528aafe46ecb746f50b5310b0463018a" data-apikey="6e7d38d5c66a82548e2717a92d97523bb6c3b7c932fc75b532ea8425762c84a7"
			  async="async"></script>
		</div>
	</div>

	<script>
		$(function () {
			$('#specialOfferHome').click(function() {
				setPromoFormStoreClicked();
			});
			var appendDots = $('<ul></ul>').addClass('home-carousel-dots').insertAfter('#home-carousel-container');
			var previousArrow =
				"<button type='button' class='carousel-prev' aria-label='Previous slide' type='button'><i class='icon-rounded-left' aria-hidden='true' /></button>";
			var nextArrow =
				"<button type='button' class='carousel-next' aria-label='Next slide' type='button'><i class='icon-rounded-right' aria-hidden='true' /></button>";
			var homeCarousel = $('#home-carousel-container');
			homeCarousel.on('init',
				function (event, slick) {
					var numSlides = slick['$slides'].length;
					for (var i = 0; i < numSlides; ++i) {
						appendDots.append('<li class="home-carousel-dot"></li>');
					}
					appendDots.children().first().addClass('dot-active');
					$('.home-carousel-dots').appendTo('#home-carousel-container');

					$('.home-carousel-dot').click(function () {
						var currIndex = appendDots.children().index(this);
						appendDots.children().removeClass('dot-active');
						$(this).addClass('dot-active');
						$('#home-carousel-container').slick('slickGoTo', currIndex);
					});
				}
			);

			// Carousel initialization
			homeCarousel.slick({
				lazyLoad: 'progressive',
				arrows: true,
				adaptiveHeight: false,
				mobileFirst: true,
				appendDots: appendDots,
				prevArrow: previousArrow,
				nextArrow: nextArrow,
				autoplay: true,
				autoplaySpeed: 10000,
			});

			homeCarousel.on("lazyLoaded", function (event, slick, image, imageSource) {
				$(image).attr("alt", $(image).attr("data-alt"));
			});

			homeCarousel.on("lazyLoadError", function (event, slick, image, imageSource) {
				$(image).attr("alt", $(image).attr("data-alt"));
			});

			homeCarousel.on('beforeChange', function (event, slick, current, next) {
				appendDots.children().removeClass('dot-active');
				$(appendDots.children()[next.toString()]).addClass('dot-active');
			});
		});
	</script>
