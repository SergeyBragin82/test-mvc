<!-- <div class='container-fluid destinations-resorts-overview-header'>
	<div class='row'>
		<div class='col-xl-6'>
			<h1>
				A World of Choice>
	_raw.Clusters			More 00 Vacation Options in the World’s Most Desirable Locations.
			</h2>
		</div>
		<div class='col-xl-6 destinations-resorts-overview-tripadvisor'>
			<div>
			</div>
		</div>
	</div>
</div> -->
<div class="destinations-title title-header text-center">
	<h1>A World of Choice</h1>
</div>

<script type="text/javascript">
	var map_data_raw = <?php echo htmlspecialchars_decode($context->xpath("//ExperienceMapData")[0]); ?>;
	var map_data = [];
</script>
<div class="overview-map">
	<?php
	$google_map_config = array(
		"css_override" => "locations-map-destinations-overview",
		"hide_ui" => "true"
	);
	include (dirname(__DIR__) . '/partials/google_map.php');
	?>
</div>
<div id="map_controls">
	<div class="text-center mb-3" id="destinations-subheader">More than 10,000 Vacation Options in the World's Most Desirable Locations.</div>
	<div class="row map-controls-toggles mx-0">
		<div class="mx-auto row">
			<div unselectable="on" class="pull-left font-weight-bold destinations-toggle" id="map_toggle_3">
				<div class="map-check" style="background-color: #299f8a">&nbsp;</div>MVC RESORTS</div>
			<div unselectable="on" class="pull-left font-weight-bold destinations-toggle" id="map_toggle_1">
				<div class="map-check" style="background-color: #88b7c5">&nbsp;</div>MARRIOTT REWARDS</div>
			<div unselectable="on" class="pull-left font-weight-bold destinations-toggle" id="map_toggle_2">
				<div class="map-check" style="background-color: #b6a885">&nbsp;</div>EXCHANGE PARTNER RESORTS</div>
			<div unselectable="on" class="pull-left font-weight-bold destinations-toggle" id="map_toggle_0">
				<div class="map-check" style="background-color: #b38a86">&nbsp;</div>EXPLORER COLLECTION</div>
		</div>
	</div>
</div>
<div id="map_nav" class="m-3" style="display:none;">
	<a href="javascript:resetMap();">
		<img src="/wp-content/plugins/mvcweb/assets/images/map_globe.png" />
	</a>
	<br/>
	<a class="map_nav_zoom" href="javascript:zoomIn();">
		<img id="map_zoom_in" src="/wp-content/plugins/mvcweb/assets/images/map_zoomin.png" />
	</a>
	<br/>
	<a class="map_nav_zoom" href="javascript:zoomOut();">
		<img id="map_zoom_out" src="/wp-content/plugins/mvcweb/assets/images/map_zoomout_disabled.png" />
	</a>
</div>
<script type="text/javascript">
	var centerControlDiv = document.getElementById("map_controls");
	var mapNavDiv = document.getElementById("map_nav");
</script>
<div class='destinations-container'>
	<h1 class='title'>
		Vacation Dreams Realized
	</h1>
	<p>Explore breathtaking locations, inspiring travels and unforgettable adventures. If you can dream it,<br/> we can help you do it!</p>
	<div class='destinations-container-experiences'>
		<h4 class='title'>
			Featured Experiences
		</h4>
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container content-row'>
						<div class='row content-row'>
							<div class='col-xl-6 image-item'>
								<div class='image-item-container'>
									<?php echo getImageTag("destinations-overview/vacationClubDestinations.jpg", "Beautiful sunrise at Marriott Vacation Club's Grande Vista resort in Orlando, Florida. ", NULL, TRUE); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Marriott Vacation Club<sup>&reg;</sup> Resorts
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 66
									</h6>
									<div class='description'>
										Relax, play and getaway at any of our 50+ premium Marriott Vacation Club Resorts.
									</div>
									<a class='marriott-btn' href='/vacation-resorts'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container content-row'>
						<div class='row content-row'>
							<div class='col-xl-6 image-item'>
							<div class='image-item-container'>
								<?php echo getImageTag('destinations-overview/propertyDestinations.jpg', 'An outside view of Singapore Marriott Tang Plaza Hotel. ', NULL, TRUE); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Marriott Rewards<sup>&reg;</sup> Hotels
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 4,887
									</h6>
									<div class='description'>
										Enjoy the reliable excellence of the Marriott family of brands.
									</div>
									<a class='marriott-btn' href='/destinations/marriott-rewards/'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
							<div class='image-item-container'>
								<?php echo getImageTag('destinations-overview/cityDestinations.jpg', 'The Top of The Strand Manhattan rooftop restaurant bar overlooking New York City at Marriott Vacation Club Pulse NYC. ', NULL, TRUE); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Marriott Vacation Club Pulse<sup>SM</sup>
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 5
									</h6>
									<div class='description'>
										Experience cultural, gastronomic and sensory delights in “must-see” cities.
									</div>
									<a class='marriott-btn' href='/marriott-vacationclub-club-resorts-pulse'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
							<div class='image-item-container'>
								
								<?php echo getImageTag('explorer-collection/Layer_48.jpg', 'A luxury cruise ship on the water with blue skies above. ', NULL, true); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Cruises
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 1,569
									</h6>
									<div class='description'>
										Ocean and river adventures you’ll share together and talk about forever.
									</div>
									<a class='marriott-btn' href='/destinations/cruises/'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
							<div class='image-item-container'>
								
								<?php echo getImageTag('destinations-overview/propertiesDestinations.jpg', 'One of many island resort vacation options available through Interval International, our Exchange Partner provider. ', NULL, TRUE); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Exchange Partner Resorts
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: Nearly 3,200
									</h6>
									<div class='description'>
										Expand your travel options even further with thousands of exchange partner resorts around the world.
									</div>
									<a class='marriott-btn' href='/destinations/exchange-partner-resorts/'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
							<div class='image-item-container'>
								
								<?php echo getImageTag('destinations-overview/natureDestinations.jpg', 'Mother and kids hiking along a pathway enjoying nature on an Adventure Travel experience. ', NULL, TRUE); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Adventure Travel
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 10
									</h6>
									<div class='description'>
										Explore off-the-beaten-path—from the jungles of the Amazon to the savannahs of Africa.
									</div>
									<a class='marriott-btn' href='/destinations/adventure-travel'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
							<div class='image-item-container'>
								
								<?php echo getImageTag('destinations-overview/guidedTours.jpg', 'Silhouette of a Giraffe standing next to a tree in the sunset. One of many Guided Tour experiences. ', NULL, TRUE); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Guided Tours
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 42
									</h6>
									<div class='description'>
										Embark on an expertly guided tour to some of the world’s most coveted destinations.
									</div>
									<a class='marriott-btn' href='/destinations/guided-tours'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
								<div class='image-item-container'>
								<?php echo getImageTag('destinations-overview/specialtyPackage.jpg', 'Couple admiring a view from a court yard. One of many Specialty Package experiences. ', NULL, true); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Specialty Packages
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 24
									</h6>
									<div class='description'>
										Customize your vacation with exclusive events packages and special access perks.
									</div>
									<a class='marriott-btn' href='/destinations/specialty-packages-activities'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
								<div class='image-item-container'>
								
								<?php echo getImageTag('destinations-overview/vacationhomes.jpg', 'Outside view of a luxury vacation home. One of many vacation homes available. ', NULL, TRUE); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Vacation Homes
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 2,525
									</h6>
									<div class='description'>
										Exquisite luxury homes, perfect for large gatherings, family reunions and grand getaways.
									</div>
									<a class='marriott-btn' href='/destinations/vacation-homes'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-6 destinations-resorts-overview-item'>
					<div class='container'>
						<div class='row'>
							<div class="col-xl-6 image-item">
							<div class='image-item-container'>
								
								<?php echo getImageTag('destinations-overview/luxury.jpg', 'View of a dining table inside of a luxury private residence. ', NULL, true); ?>
</div>
							</div>
							<div class="col-xl-6 content">
								<div class='destinations-resorts-overview-item-content'>
									<h5 class='title'>
										Hotels and Luxury Residences
									</h5>
									<h6 class='subtitle'>
										Number of Experiences: 81
									</h6>
									<div class='description'>
										Escape to an extraordinary hotel or indulge yourself at an amazing private residence club.
									</div>
									<a class='marriott-btn' href='/destinations/explorer-collection/hotels-and-luxury-residences/'>see more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="px-4">
<p>The number of experiences are updated quarterly.</p>
<p>Other than Marriott Vacation Club Resorts available in the MVC Trust as Trust Property, the Featured Experiences are available only through the Marriott Vacation Club Destinations Exchange Program.</p> 
</div>
<?php echo horizontalBreak(); ?>
