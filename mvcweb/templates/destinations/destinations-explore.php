<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$interests = $context->xpath('//Interest');
$resorts = $context->xpath('//Resort');
$heroTitle = "What Does Exploration Look Like to You";
$heroContent = array(
	0 => new HeroContent(array(
		"contentParagraph" => "<i>All you ever (or never) dreamed of doing.</i>
Discover exceptional travel opportunities and one-of-a-kind adventures, including cruises, guided tours, culinary tours, safaris, mountain biking and more.

Whether you want to explore the Mediterranean on a luxury cruise or the Amazon jungle on a guided tour, the Explorer Collection<a class='general-info-link' href='/state-and-legal-disclosures#legal4'><sup>4</sup></a> of the Marriott Vacation Club Destinations Exchange Program, has immersive travel experiences ready for you, provided by affiliate travel providers."
	))
);
echo heroElementTemplate($heroTitle, "family-village.jpg", "Couple admiring the view of an old stone arched bridge and lush green landscapes.  An immersive vacation is waiting for you, provided by affiliate tour operators.", $heroContent);
 ?>

	<div class='destinations-container-explore image-description-container'>
		<div class='row'>
			<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4'>
				<div class='image-description-parent'>
					<a href="/destinations/explorer-collection/hotels-and-luxury-residences/">
					<div class='image-container'>
						<?php echo getImageTag('explorer-collection/explorerSkyline.jpg', 'View of the Empire State Building in New York City. Enjoy hotels and luxury residences with the Marriott Family of brands. ', NULL, true); ?>
					</div>
					</a>
					<div class='text-content'>
						<h4>Hotels &amp; Luxury Residences</h4>
						<p>Discover vibrant and iconic cities across North America and around the world.</p>

					</div>
					<div class='text-center image-description-button'>
						<a class='btn marriott-btn' href='/destinations/explorer-collection/hotels-and-luxury-residences/'>
							learn more
						</a>
					</div>
				</div>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4'>
				<div class='image-description-parent'>
					<a href="/destinations/explorer-collection/cruises">
					<div class='image-container'>
						<?php echo getImageTag('explorer-collection/Cruise_2.jpg', 'Cruise ship resting just off a tropical island.  Cruise vacations are shared and talked about forever. ', NULL, true); ?>
					</div>
					</a>
					<div class='text-content'>
						<h4>Cruises</h4>
						<p>Ocean and river adventures you'll share together and talk about forever.</p>

					</div>
					<div class='text-center image-description-button'>
						<a class='btn marriott-btn' href='/destinations/explorer-collection/cruises'>
							learn more
						</a>
					</div>
				</div>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4'>
				<div class='image-description-parent'>
					<a href="/destinations/explorer-collection/guided-tours">
					<div class='image-container'><?php echo getImageTag('explorer-collection/guided-tours.jpg', 'Group embarking on a tour in Volterra, Italy. ', NULL, true); ?></div>
					</a>
					<div class='text-content'>
						<h4>Guided Tours</h4>
						<p>Embark on an expertly guided tour to some of the world's most sought-after destinations.</p>

					</div>
					<div class='text-center image-description-button'>
						<a class='btn marriott-btn' href='/destinations/explorer-collection/guided-tours'>
							learn more
						</a>
					</div>
				</div>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4'>
				<div class='image-description-parent'>
					<a href="/destinations/explorer-collection/vacation-homes">
					<div class='image-container'><?php echo getImageTag('explorer-collection/vacation-homes.jpg', 'A magnificent pool view at a luxury vacation home overlooking the ocean. Over 2.000 vacation homes at your fingertips. ', NULL, true); ?></div>
					</a>
					<div class='text-content'>
						<h4>Vacation Homes</h4>
						<p>Exquisite luxury homes, perfect for large gatherings, family reunions and grand getaways.</p>

					</div>
					<div class='text-center image-description-button'>
						<a class='btn marriott-btn' href='/destinations/explorer-collection/vacation-homes'>
							learn more
						</a>
					</div>
				</div>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4'>
				<div class='image-description-parent'>
					<a href="/destinations/explorer-collection/adventure-travel">
					<div class='image-container'><?php echo getImageTag('explorer-collection/adventure-travel.jpg', 'Country-side view off the beaten path.  Adventures for you to experience from an Amazon jungle to African savannahs. ', NULL, true); ?></div>
					</a>
					<div class='text-content'>
						<h4>Adventure Travel Experiences</h4>
						<p>Explore off-the-beaten paths &mdash; from the jungles of the Amazon to the savannahs of Africa.</p>

					</div>
					<div class='text-center image-description-button'>
						<a class='btn marriott-btn' href='/destinations/explorer-collection/adventure-travel'>
							learn more
						</a>
					</div>
				</div>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4'>
				<div class='image-description-parent'>
					<a href="/destinations/explorer-collection/specialty-packages-activities">
					<div class='image-container'><?php echo getImageTag('explorer-collection/specialty.jpg', 'Couple walking down a corridor near Play Andaluza in Estepona, Spain. ', NULL, true); ?></div>
					</a>
					<div class='text-content'>
						<h4>Specialty Packages &amp; Activities</h4>
						<p>Pre-packaged weekends, exclusive perks and activities to make your vacation even more memorable.</p>

					</div>
					<div class='text-center image-description-button'>
						<a class='btn marriott-btn' href='/destinations/explorer-collection/specialty-packages-activities'>
							learn more
						</a>
					</div>
				</div>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4'>
				<div class='image-description-parent'>
				<div class='image-container'><?php echo getImageTag('explorer-collection/KOO-LP-207.jpg', 'A couple enjoying a meal and a cocktail at an outdoor table by two tiki torches. ', NULL, true); ?></div>
					<div class='text-content'>
						<h4>Travel Arrangements &amp; Insurance</h4>
						<p>Book your travel and insure your trip using Vacation Club Points.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo horizontalBreak(); ?>
	<script>
		setDataLayerGenericPage(
			ownershipSiteSection,
			'MVC - Explorer Collection',
		);
	</script>
