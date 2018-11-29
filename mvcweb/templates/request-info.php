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
				'' :
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
				$('#vacationExperiences .row').removeClass('row');
				var experiences = $('#vacationExperiences');
				experiences.find('.kessel-header').hide();
				var titleDesc = experiences.find('.title-description');
				titleDesc.css({
					'padding-top': '0',
				}).find('p').html(
					"When you contract to purchase 1,500 Vacation Club Points in the Marriott Vacation Club Destinations<sup>&reg;</sup> timeshare plan by December 30, 2018, the 2019 Exchange Company Dues will be on us! Plus, choose what else we can cover for you – closing costs or the 2019 maintenance fees for your new purchase!<br /><br />As an Owner, you will have access to a vast and diverse collection of resorts, properties and experiences including cruises, adventure travel, guided tours and more. Our timeshare ownership and exchange programs will help you make the most of every precious vacation moment.<br /><br />Don’t miss your opportunity to become an Owner and save!<br /><br />For details about this offer, scroll down to see the Details of Participation, <a href='/request-information/''>Request Information</a> or <strong>Call 800-307-7312</strong>.").before('<h2>Limited-Time Offer with New Ownership</h2>').end().removeAttr('class').parent().removeAttr('class');
				experiences.find('.marriott-btn').hide();
				experiences.find('.action-list').hide();

				var quality = $('#marriottQuality');
				quality.before(
					$('<div>').addClass('container-fluid body-content').append(
						$('<p>')
							.css({
								"padding-bottom": "2rem"
							}).html('<div class="break" style="padding-top: 1em; padding-bottom: 2em;"><hr></div><strong>LEGAL:</strong><br><h6>Details of Participation</h6>Sponsor: Marriott Ownership Resorts, Inc. d/b/a Marriott Vacation Club International<br><br>Eligibility: With the new purchase and closing on a minimum of 1,500 Vacation Club Points, the purchaser’s 2019 Exchange Company Dues for this purchase will be paid by Marriott Vacation Club International as a special purchase incentive. The Exchange Company Dues payment will be applied by Marriott Vacation Club International within 45 days after closing. In addition, as a special purchase incentive, the purchaser may choose to (i) have the closing costs for this purchase paid Marriott Vacation Club International at time of closing OR (ii) have the 2019 maintenance fees for the Vacation Club Points purchased in connection with this offer, paid by Marriott Vacation Club International within 45 days after closing. The purchaser will remain obligated to pay all Exchange Company Dues and maintenance fees owed for all other Marriott Vacation Club interest, if any. Closing of this purchase is required to receive offer. This offer is not available with any other promotional offer, including resort marketing packages. Offer subject to change without notice. Offer expires December 30, 2018. This special offer is only for purchasers who are residents of the 50 states within the United States, including the District of Columbia but excluding Alabama, Delaware, Hawaii, Maine, Missouri and West Virginia. Purchaser must call to initiate the purchase, sign and return all required contract and closing documents for the purchase of at least 1,500 Vacation Club Points, which must be received by Marriott Vacation Club International, Central Sales Distribution, 6649 Westwood Boulevard, Suite 500, Orlando, Florida 32821, no later than December 30, 2018, to receive this special offer. The contract documents will be mailed out via FedEx courier services and a FedEx envelope will be included for the return of the contract documents. Offer is not available with any other promotional offer, including resort marketing packages.<br /><span style="float: right;">MDC-18-311</span>')
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