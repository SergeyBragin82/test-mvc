<?php
	include(dirname(__FILE__) . '/common.php');
	$genericIcon = 'GenericIcon.png';
	$genericIconAlt = 'Generic List Icon';

?>
	<div class='request-info'>
		<div class='container-fluid hero-element'>
			<div class='row'>
				<div class='col-xl-4'>
					<div class='hero-element-info'>
						<h1 class='hero-element-info-header'>
						</h1>
						<div class='break'>
							<hr />
						</div>
						<div class='hero-element-info-body'>
							<p>
							</p>
							<div class='request-info-main'>
								<strong class='title'>
									are you already a marriott vacation club owner?
								</strong>
								<div class='request-info-main-options'>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" name="inlineRadioOptions" id="vacationOwnerYes" value="yes" required> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" name="inlineRadioOptions" id="vacationOwnerNo" value="no"> No
										</label>
									</div>
									<div class='invalid-feedback' id='invalidOwnerType' style='display: none;'>
										You must select an option before proceeding.
									</div>
								</div>
								<a class='marriott-btn' id='vacationOwnerNext' href='#'>
									next
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class='col-xl-8 cover-picture-container'>
					<?php echo getImageTag("GV-LP-081.jpg", "Family having fun roasting marshmellows at a Marriott Vacation Club timeshare resort. ", array(0 => 'content'), true); ?>
				</div>
			</div>
		</div><a href="" title=""></a>
		<div class='ownership-about-mvc'>
			<?php
	echo getUnforgettableExperiences();
	echo horizontalBreak();
	echo getMarriottQuality()
?>
		</div>
	</div>
	<?php echo horizontalBreak(); ?>
	<script>
		$(function () {
			var headerPromotion = store.get('headerPromotion') === 'clicked';

			// Check for "offer=bonus" in parameter in query string (params.getAll returns array)
			if( getUrlParam('offer') === "bonus" ){
				headerPromotion = true;
			}

			$('.hero-element-info-header').html(
				headerPromotion ?
				'Special Offer' : 'Help Us Get to Know You'
			);
			$('.hero-element-info-body > p').html(
				headerPromotion ?
				'Become an Owner and Receive a Bonus Vacation' :
				'We want to get you exactly what you’re looking for so you can get out there and enjoy the vacation lifestyle.'
			);
			if(headerPromotion) {
				var image = $('.cover-picture-container').find('img');
				image.hide();
				$('.cover-picture-container').append($('<img>').addClass('content').on('load', function() {
					$(this).fadeIn();
				}).attr({
					src: <?php echo json_encode($GLOBALS['img_path'] . '201809/NewportCoastVillas02_1200x900.jpg');?>,
					alt: 'View of the main pool at Marriott\'s Newport Coast Villas in Newport Coast, California.'
				}));
				var experiences = $('#vacationExperiences');
				experiences.css({
					"padding-bottom": "2rem"
				});
				experiences.find('.kessel-header').hide();
				var titleDesc = experiences.find('.title-description');
				titleDesc.css({
					'padding-top': '0',
				}).find('p').html(
					"When you become an Owner in the Marriott Vacation Club Destinations<sup>&reg;</sup> Program with a purchase of at least 2,500 Vacation Club Points by September 29, 2018, you’ll receive 2,500 PlusPoints. Redeem your PlusPoints toward up to 6 nights* at any available Marriott Vacation Club<sup>&reg;</sup> property worldwide. Choose from more than 50 properties in popular destinations worldwide.").before('<h2>Say Hello to a Bonus Vacation!</h2>').end().removeAttr('class').parent().removeAttr('class');
				experiences.find('.marriott-btn').hide();
				experiences.find('.action-list').hide();

				var quality = $('#marriottQuality');
				quality.before(
					$('<div>').addClass('container-fluid body-content').append(
						$('<p>')
							.css({
								"padding-bottom": "2rem"
							})
							.html('<strong>DISCLAIMER:</strong><br/>*The number of nights that may be available using 2,500 PlusPoints depends on the resort, its location, dates and unit type/view requested.<br/><br/><b>LEGAL:</b><br><h6>Details of Participation</h6>Sponsor: Marriott Ownership Resorts, Inc. d/b/a Marriott Vacation Club International<br><br>Eligibility: With the new purchase and closing on a minimum of 2,500 Vacation Club Points, purchaser will receive the matching number of PlusPoints as the contracted purchase as a special purchase incentive. PlusPoints may be redeemed for nights at any available Marriott Vacation Club<sup>&reg;</sup> resort or property. This special purchase offer is only for purchasers who are residents of the 50 states within the United States, including the District of Columbia but excluding Delaware, Hawaii, West Virginia and Missouri. Purchaser must call to initiate the purchase, sign and return contract documents for the purchase of at least 2,500 Vacation Club Points to Marriott Vacation Club, Central Sales Distribution, 6649 Westwood Boulevard, Suite 500, Orlando, Florida 32821, no later than September 29, 2018, to receive the 2,500 PlusPoints. The contract documents will be mailed out via FedEx courier services and a FedEx envelope will be included for the return of the contract documents. The Vacation Club Points and PlusPoints necessary to occupy specific resorts for a specific number of nights may change from time to time and is determined by the time of year, days of week of stay, view and bedroom type reserved. Reservations are subject to availability. PlusPoints can be used to reserve accommodations and other Exchange Benefits within the Marriott Vacation Club Destinations<sup>&reg;</sup> Exchange Program, subject to terms and conditions of the Exchange Company Documents. PlusPoints expire 24 months from deposit. PlusPoints will be deposited within 30 days from date of closing. Offer expires September 29, 2018. Offer is not available with any other promotional offer, including resort marketing packages. Offer subject to change without notice. PlusPoints are nontransferable and may not be banked, borrowed or traded for Marriott Rewards<sup>&reg;</sup> points. <strong>Airfare, ground transportation, gratuities, additional expenses and applicable taxes, if any, are not included with this offer.</strong><br /><span style="float: right;">MDC-18-223</span>')
					)
				);
				quality.before(
						$('<div>').addClass('break').css('margin-top', '1rem').append(
							$('<hr>')
						)
					)
			}
			var selection = '';
			var vacationOwnerYesInput = $('#vacationOwnerYes');
			var vacationOwnerNoInput = $('#vacationOwnerNo');
			var checkSelection = function () {
				if (vacationOwnerYesInput.prop('checked')) {
					selection = 'yes';
				} else if (vacationOwnerNoInput.prop('checked')) {
					selection = 'no';
				}
				changeLandingNextStep(selection);
			}
			var handleMainOptionClick = function () {
				selection = $(this).val();
				changeLandingNextStep(selection);
			}

			var changeLandingNextStep = function (selected) {
				var ownerNextButton = $('#vacationOwnerNext');
				if (selected === 'yes') {
					ownerNextButton.attr('href', '/request-info-owner');
					if (headerPromotion) {
						store.set('headerPromotionOwner', 'firstStepOwner');
					}
					
				} else if (selected === 'no') {
					ownerNextButton.attr('href', '/request-info-new-owner');
					if (headerPromotion) {
						store.set('headerPromotionProspect', 'firstStepProspect');
					}
				}
				$('#invalidOwnerType').hide();
			}
			checkSelection();

			$('#vacationOwnerNext').click(function () {
				if (!vacationOwnerYesInput.prop('checked') && !vacationOwnerNoInput.prop('checked')) {
					$('#invalidOwnerType').show();
				} else {
					$('#invalidOwnerType').hide();
				
				}
			});
			vacationOwnerYesInput.click(handleMainOptionClick);
			vacationOwnerNoInput.click(handleMainOptionClick);
			digitalData.pageInfo.formSerial = getUniqueID();
			satelliteTrack('step1: request info');
			//console.log(digitalData);
		});
	</script>
