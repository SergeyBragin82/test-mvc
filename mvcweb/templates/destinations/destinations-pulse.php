<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$heroTitle = "Marriott Vacation Club Pulse<span class='trademark'>SM</span>";
$heroContent = array(
	0 => new HeroContent(array(
		"contentTitle" => "In The Heart Of It All",
		"contentParagraph" => "Marriott Vacation Club Pulse proudly offers distinctive guestrooms and suites in vibrant cities. Enjoy being close to major attractions, local points of interest and easy-to-access transportation. You’ll be where the action is, with discovery and adventure around every corner."
	)),
);
// $resortPulseItems = array(
// 	0 => (object)(array(
// 		'image' => 'club-pulse-featured/sanDiego.jpg',
// 		'caption' => 'Exterior Marriott Vacation Club Pulse San Diego',
// 		'name' => 'Marriott Vacation Club Pulse<sup>SM</sup>, San Diego',
// 		'city' => 'San Diego, California',
// 		'intro' => 'Your stylish downtown San Diego retreat offers an ideal central location for exploring all that San Diego has to offer. From the bustling Gaslamp Quarter, to Balboa Park, home to many of San Diego’s museums and cultural venues as well as the legendary San Diego Zoo.',
// 		'mvwcTrustResorts' => 'true',
// 		'mvwcExchangeResorts' => 'true',
// 		'permalink' => 'sanva-marriott-vacation-club-pulsex2120-san-diego',
// 	)),
// 	1 => (object)(array(
// 		'image' => 'club-pulse-featured/washington.jpg',
// 		'caption' => 'Exterior Marriot Vacation Club Pulse Washington D.C.',
// 		'name' => 'Marriott Vacation Club Pulse<sup>SM</sup> at The Mayflower, Washington, D.C',
// 		'city' => 'Washington, D.C.',
// 		'intro' => 'Here, you have the extraordinary opportunity to become a part of history by staying in a Washington, D.C. landmark. Offering an incredible downtown location - inside the iconic Mayflower Hotel – this property sets the stage for a landmark getaway. ',
// 		'mvwcTrustResorts' => 'true',
// 		'mvwcExchangeResorts' => 'true',
// 		'permalink' => 'wasmv-marriott-vacation-club-pulsex2120-at-the-mayflower-washington-dc',
// 	)),
// 	2 => (object)(array(
// 		'image' => 'club-pulse-featured/miami.jpg',
// 		'caption' => 'Exterior Marriot Vacation Club Pulse Miami',
// 		'name' => 'Marriott Vacation Club Pulse<sup>SM</sup>, South Beach',
// 		'city' => 'Miami, Florida',
// 		'intro' => 'Built in 1936, this lovingly restored Mediterranean Revival gem is one of Ocean Drive’s most iconic properties. Graceful curves and trademark red roof tiles welcome guests with an enchanting mix of history and unique contemporary design.',
// 		'mvwcTrustResorts' => 'true',
// 		'mvwcExchangeResorts' => 'true',
// 		'permalink' => 'miamv-marriott-vacation-club-pulsex2120-south-beach',
// 	)),
// 	3 => (object)(array(
// 		'image' => 'club-pulse-featured/boston.jpg',
// 		'caption' => 'Exterior Marriot Vacation Club Pulse Boston',
// 		'name' => 'Marriott Vacation Club Pulse<sup>SM</sup> at Custom House, Boston',
// 		'city' => 'Boston, Massachusetts',
// 		'intro' => "Located within the historic Boston Custom House, this elegant urban retreat provides gracious views of Boston Harbor as well as convenient access to the city's historic Freedom Trail.",
// 		'mvwcTrustResorts' => 'false',
// 		'mvwcExchangeResorts' => 'true',
// 		'permalink' => 'bosch-marriott-vacation-club-pulsex2120-at-custom-house-boston',
// 	)),
// 	4 => (object)(array(
// 		'image' => 'club-pulse-featured/nyc.jpg',
// 		'caption' => 'Exterior Marriot Vacation Club Pulse New York City',
// 		'name' => 'Marriott Vacation Club Pulse<sup>SM</sup>, New York City',
// 		'city' => 'new york city, new york',
// 		'intro' => 'After a full day of adventures in the city, relax in your beautifully appointed room or — better yet — in one of New York City’s most spectacular rooftop bars, your very own urban oasis.',
// 		'mvwcTrustResorts' => 'false',
// 		'mvwcExchangeResorts' => 'true',
// 		'permalink' => 'nycvc-marriott-vacation-club-pulsex2120-new-york-city',
// 	)),
// );
echo heroElementTemplate($heroTitle, "club-pulse-featured/heroPulseFeatured.jpg", "hero-image-alt", $heroContent, 'image-120');

// TODO: make a method that retrieves all the necessary info
// to display a resort into an object for display

	function resortListItem($resortInfo) {
		$resortPicture =  getImageTag($resortInfo->image->image, $resortInfo->image->caption, array(0 => 'img-fluid'), FALSE);
		$displayTopResort = $resortInfo->mvwcTrustResorts == 'true' ? 'display: inline-block;' : 'display: none;';
		$displayExchangeResort = $resortInfo->mvwcExchangeResorts == 'true' ? 'display: inline-block;' : 'display: none;';
		$resortName = $resortInfo->name;
		$permalink = '/vacation-resorts/' . $resortInfo->permalink;
		return <<<HTML
			<div class='destinations-resorts-item'>
		<div class='container'>
			<div class='row'>
				<div class="col-xl-6 image-col">
					<a href='$permalink'>
						<div class='image-parent'>
							$resortPicture
						</div>
					</a>
				</div>
				<div class="col-xl-6 destinations-resort-item-column-content">
					<div class='destinations-resorts-item-content'>
						<div id='resortTitleContainer'>
							<a href="$permalink">
								<h4 class='title'>$resortName
									<div class='resort-header-link' data-toggle='tooltip' data-placement='bottom' title='Marriott Vacation Club Trust' style='$displayTopResort'>
									T
								</div>
								<div class='resort-header-link' data-toggle='toooltip' data-placement='bottom' title='Marriott Vacation Club Destination Exchange Program' style='$displayExchangeResort'>
									E
								</div>
								</h4>
							</a>
						</div>
						<h5 class='location-title'>
							$resortInfo->city
						</h5>
						<p class='description'>
							$resortInfo->description
						</p>
						<div class='interests'>
						</div>
						<a class='marriott-btn' href='$permalink'>explore property</a>
					</div>
				</div>
			</div>
		</div>
	</div>
HTML;
	}
 ?>
	<div class='destinations-container'>
		<h2 class='destinations-center-header'>
			Iconic Locations
		</h2>
		<p style='text-align: center;'>Let curiosity be your guide, discovery be your agenda and Marriott Vacation Club Pulse be your host.</p>
	</div>
	<div class='destinations-resorts destinations-pulse-container'>
		<div class='destinations-container destinations-resorts-list'>
			<?php
			foreach($context->xpath('//Resort') as $pulseResort) {
				echo resortListItem($pulseResort);
			}
		 ?>
		</div>
	</div>
