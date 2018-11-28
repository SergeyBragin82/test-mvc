<?php
	include(dirname(__FILE__) . '/partials/forms.php');
	include(dirname(__FILE__) . '/common.php');
	$map_key = get_param("GOOGLE_MAPS_API_KEY");
	$ownerTipsContent = array(
		0 => new ColumnItemContent(array(
			'imgPath' => 'fire.jpg',
			'imgAlt' => 'View of an outdoor fireplace with ski gondolas in the background. ',
			'contentHeader' => 'Reserve Early',
			'contentParagraph' => 'Reservations are made on a first-come, first-served basis and subject to availability, so it helps to plan ahead. If you plan to stay at a Marriott Vacation Club resort, you may make reservations as early as 13 months prior to your check-in date, subject to your benefit level. Also, your Vacation Club Points can be borrowed (or exchanged for Marriott Rewards points) 25 months before your Use Year begins.',
		)),
		1 => new ColumnItemContent(array(
			'imgPath' => 'beach.jpg',
			'imgAlt' => 'Young child drawing art shapes on a beach with her family playing in the ocean behind her. ',
			'contentHeader' => 'Website & Webinars',
			'contentParagraph' => "<br><a class='general-info-link' href='https://owners.marriottvacationclub.com/timeshare/mvco/owner/login' target='_blank'>Owners.MarriottVacationClub.com</a> is where you'll find just about everything: easy-to-use planning information, booking tools, Owners resources, Point calculators and more.<br><br>At <a class='general-info-link' href='http://www.vacationclublearningcenter.com/' target='_blank'>VacationClubLearningCenter.com</a>, you’ll find short, informative webinars that cover topics such as ownership levels, point uses, and tips for getting the most out of your ownership.",
		)),
		2 => new ColumnItemContent(array(
			'imgPath' => 'golf.jpg',
			'imgAlt' => 'Two friends teeing off at an ocean front golf course. Blue skies and palm trees in the background. ',
			'contentHeader' => 'Safeguard Vacations',
			'contentParagraph' => "Because sometimes even the best-planned trips don’t go as planned, Marriott Vacation Club has created a travel protection plan specifically suited to the needs of our Owners. For details, call <a class='telephone-number' href='tel:+18556824847'>855-MVC-4VIP (855-682-4847)</a>.",
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
						<?php echo requestInfoForm(TRUE); ?>
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
		?>
		<div class='container-fluid body-content' id='ownerTipsResources'>
			<div class="kessel-header">
				Owner tips &amp; Resources
			</div>
			<?php
				echo columnListItemWithPicture($ownerTipsContent);
			?>
		</div>
		<?php
			echo getMarriottQuality();
		?>

	</div>
</div>
<?php
	echo horizontalBreak();
	include(dirname(__FILE__) . '/api/request_info_owner.php');
?>
