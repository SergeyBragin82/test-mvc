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
					<?php echo getImageTag("201809/1200x900_NewYork_1.jpg", "New York City", array(0 => 'content'), true); ?>
				</div>
			</div>
		</div><a href="" title=""></a>
		<div class='ownership-about-mvc'>
			<?php
	echo getUnforgettableExperiences();
	echo getMarriottQuality()
?>
		</div>
	</div>
	<?php echo horizontalBreak(); ?>
	<script>
		$(function () {
			var urlParams = new URLSearchParams(window.location.search);			

			var headerPromotion = store.get('headerPromotion') === 'clicked';

			// Check for "offer=bonus" in parameter in query string (params.getAll returns array)
			if(getUrlParam('offer') === "bonus" ){
				headerPromotion = true;
			}

			if(urlParams.has('headerPromotion')){
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
					src: <?php echo json_encode($GLOBALS['img_path'] . '201810/41286/WaikoloaOceanClub01_1200x900.jpg');?>,
					alt: 'View of the Marriott\'s Waiohai Beach Club.'
				}));
				var experiences = $('#vacationExperiences');
				experiences.find('.kessel-header').hide();
				var titleDesc = experiences.find('.title-description');
				titleDesc.css({
					'padding-top': '0',
				}).find('p').html(
					"When you become an Owner in the Marriott Vacation Club Destinations<sup>&reg;</sup> Program with a purchase of at least 2,500 Vacation Club Points by November 29, 2018, you’ll <strong>receive 2,500 PlusPoints</strong>. Redeem your PlusPoints toward up to 6 nights* at any available Marriott Vacation Club<sup>&reg;</sup> property worldwide. Choose from more than 50 properties in popular destinations worldwide, including some of Hawaii's most beautiful islands:<br /><br /><strong>Big Island</strong><br />Marriott's Waikoloa Ocean Club<br /><br /><strong>Kauai</strong><br />Marriott's Kauai Lagoons — Kalanipu'u<br />Marriott's Waiohai Beach Club<br /><br /><strong>Maui</strong><br />Marriott's Maui Ocean Club<br /><br /><strong>Oahu</strong><br />Marriott's Ko Olina Beach Club<br /><br />").before('<h2>Say Aloha to a Bonus Vacation!</h2>').end().removeAttr('class').parent().removeAttr('class');
				experiences.find('.marriott-btn').hide();
				experiences.find('.action-list').hide();

				var quality = $('#marriottQuality');
				quality.before(
					$('<div>').addClass('container-fluid body-content').append(
						$('<p>')
							.css({
								"padding-bottom": "2rem"
							})
							.html('<p>For details about this limited-time offer, scroll down to see Details of Participation, <a href="/request-information/">request information</a> OR call 800-307-7312.</p><div class="break" style="padding-top: 1em; padding-bottom: 2em;"><hr></div><strong>DISCLAIMER:</strong><br/>*The number of nights that may be available using 2,500 PlusPoints depends on the resort, its location, dates and unit type/view requested.<br/><br/><b>LEGAL:</b><br><h6>Details of Participation</h6>Sponsor: Marriott Ownership Resorts, Inc. d/b/a Marriott Vacation Club International<br><br>Eligibility: With the new purchase and closing on a minimum of 2,500 Vacation Club Points, purchaser will receive the matching number of PlusPoints as the contracted purchase as a special purchase incentive. PlusPoints may be redeemed for nights at any available Marriott Vacation Club<sup>&reg;</sup> resort or property. This special purchase offer is only for purchasers who are residents of the 50 states within the United States, including the District of Columbia but excluding Delaware, Hawaii, West Virginia, Maine and Missouri. Purchaser must call to initiate the purchase, sign and return contract documents for the purchase of at least 2,500 Vacation Club Points to Marriott Vacation Club, Central Sales Distribution, 6649 Westwood Boulevard, Suite 500, Orlando, Florida 32821, no later than November 29, 2018, to receive the 2,500 PlusPoints. The contract documents will be mailed out via FedEx courier services and a FedEx envelope will be included for the return of the contract documents. The Vacation Club Points and PlusPoints necessary to occupy specific resorts for a specific number of nights may change from time to time and is determined by the time of year, days of week of stay, view and bedroom type reserved. Reservations are subject to availability. PlusPoints can be used to reserve accommodations and other Exchange Benefits within the Marriott Vacation Club Destinations<sup>&reg;</sup> Exchange Program, subject to terms and conditions of the Exchange Company Documents. PlusPoints expire 24 months from deposit. PlusPoints will be deposited within 30 days from date of closing. Offer expires November 29, 2018. Offer is not available with any other promotional offer, including resort marketing packages. Offer subject to change without notice. The utilization of any PlusPoints will be subject to any terms and conditions under which such PlusPoints are granted, including, without limitation, any applicable expiration dates on such PlusPoints. If PlusPoints are used to make a reservation, additional fees may be required to complete the reservation in order to offset any applicable taxes. PlusPoints are nontransferable and may not be banked, borrowed or traded for Marriott Rewards<sup>&reg;</sup> points. <strong>Airfare, ground transportation, gratuities, additional expenses and applicable taxes, if any, are not included with this offer.</strong><br /><span style="float: right;">MDC-18-252</span>')
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

			// ENTER key triggers NEXT
			$(document).keypress(function(event){
			    if(event.keyCode == 13) { 
			    	if ($("#vacationOwnerNext").attr("href") != "#") {
			        	window.location.replace($("#vacationOwnerNext").attr("href"));
			        } else {
			        	$("#invalidOwnerType").show();
			        }
			    }
			});
		});
	</script>