<?php
	include(dirname(__FILE__) . '/partials/forms.php');
	include(dirname(__FILE__) . '/common.php');
	$map_key = get_param("GOOGLE_MAPS_API_KEY");
	$genericIcon = 'GenericIcon.png';
	$genericIconAlt = 'Generic List Icon';
	$contentItem = array(
		0 => new ColumnItemContent(array(
			'imgPath' => 'fire.jpg',
			'imgAlt' => 'View of an outdoor fireplace with ski gondolas in the background. ',
			'contentHeader' => 'World Class Resorts',
			'contentParagraph' => 'Relax, play and get away for a memory-making get-together at
			any of our 50+ exceptional Marriott Vacation Club resorts,
			each designed to rejuvenate souls, connect families and enrich
			lives.',
			'buttonText' => 'SEE MVC RESORTS',
			'buttonHref' => '#'
		)),
		1 => new ColumnItemContent(array(
			'imgPath' => 'beach.jpg',
			'imgAlt' => 'Young child drawing art shapes on a beach with her family playing in the ocean behind her. ',
			'contentHeader' => 'Specialty Travel & Experiences',
			'contentParagraph' => 'Browse our curated collection of  vacation experiences and live
			a vacation life full of exploration and discovery, from cruises
			to safaris to private luxury homes and more.',
			'buttonText' => 'SEE EXPLORE COLLECTION',
			'buttonHref' => '#'
		)),
		2 => new ColumnItemContent(array(
			'imgPath' => 'golf.jpg',
			'imgAlt' => 'Two friends teeing off at an ocean front golf course. Blue skies and palm trees in the background. ',
			'contentHeader' => 'Personalized Vacation Guidance',
			'contentParagraph' => 'Our vacation ownership advisors will help you get the most out
			of your vacation ownership. Their mission is to help you plan
			and experience unforgettable vacations year after year.',
			'buttonText' => 'CONTACT US',
			'buttonHref' => '#'
		)));
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php print $map_key; ?>&callback=gMapsInit" defer></script>
<div class='request-info'>
	<div class='container-fluid hero-element'>
		<div class='row'>
			<div class='col-xl-4'>
				<div class='hero-element-info'>
					<h1 class='hero-element-info-header' id='newOwnerStepTitle'>
					</h1>
					<div class='break'>
						<hr />
					</div>
					<div class='hero-element-info-body'>
						<div id='infoFormDescription'>
							<p></p>
						</div>
						<?php echo requestInfoForm(); ?>
						<button class='marriott-btn' id='infoFormButton' name='requestInfoSubmit'>
							next
						</button>
					</div>
				</div>
			</div>
			<div class='col-xl-8 cover-picture-container'>
				<?php echo getImageTag("GV-LP-081.jpg", "Family having fun roasting marshmellows at a Marriott Vacation Club timeshare resort. ", array(0 => 'content'), true); ?>
			</div>
		</div>
	</div>
	<div class='ownership-about-mvc'>
		<?php
		 	echo getUnforgettableExperiences();
			echo horizontalBreak();
			echo getMarriottQuality();
			echo getWhatHappensNext();
		?>
	</div>
</div>
<?php
	echo horizontalBreak();
	include(dirname(__FILE__) . '/api/request_info_new_owner.php');
?>
