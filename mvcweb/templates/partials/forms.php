<?php
	function formRequiredMetadata($templateID, $typeID, $statusID, $queueID, $data = '') {
		return <<<HTML
		<input type='hidden' name='MessageTemplateID' value='$templateID'>
		<input type='hidden' name='MessageTypeID' value='$typeID'>
		<input type='hidden' name='MessageStatusID' value='$statusID'>
		<input type='hidden' name='WorkQueueID' value='$queueID'>
		<input type='hidden' name='data' value='$data'>
HTML;
	}

	function ownerSelectionForm() {
		return <<<HTML
			<div class='request-info-owner-options' id='requestInfoOwnerOptions'>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input" type="radio" name="ownerSelection" value="I'm an owner and I want to learn more about Vacation Club Points." required>
						I am interested in Vacation Club Points
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input" type="radio" name="ownerSelection" value="I’m an owner and I have a question about my account or vacation plans." required>
						I have an Owner Services question
					</label>
				</div>
			</div>
			<div class='invalid-feedback' id='ownerSelectionError' style='display: none;'>
				You must select an option before proceeding.
			</div>
HTML;
	}
	function requestInfoForm($addOwnerOptions = FALSE) {
		$actionURL = esc_url(admin_url('admin-post.php'));
		$ownerOptions = '';
		if ($addOwnerOptions) {
			$ownerOptions = ownerSelectionForm();
		}
		$countryList = getCountryList();
		return <<<HTML
		<style type="text/css" media="screen">
			.gdpr-disclaimer {
				display: none;
				font-size: smaller;
			}
		</style>
		<div class='request-info-form'>
			<form id='requestInfoForm' method='post' action="$actionURL">
				$ownerOptions
				<div id='firstStepInfoForm' style='display: none;'>
					<div class="form-group">
						<label for="firstNameInfoForm">First Name</label>
						<input type="text" class="form-control" name="firstName" id="firstNameInfoForm" aria-describedby="firstName" placeholder="" required>
						<div class='invalid-feedback' id='firstNameError' style='display: none;'>
								Please provide a First Name.
						</div>
					</div>
					<div class="form-group">
						<label for="lastNameInfoForm">Last Name</label>
						<input type="text" class="form-control" name="lastName" id="lastNameInfoForm" placeholder="" required>
						<div class='invalid-feedback' id='lastNameError' style='display: none;'>
								Please provide a Last Name.
						</div>
					</div>
					<div class="form-group">
						<label for="countryCodeSelect">Country/Region of Residence</label>
						<select class="form-control" id="countryCodeSelect" name="addressCountryCode" required>
							<option value='' style='display: none;' selected>Select Country/Region of Residence</option>
							$countryList
						</select>
						<div class='invalid-feedback' id='countrySelectError' style='display: none;'>
								You must select a country before proceeding.
						</div>
						<p class="gdpr-disclaimer" id="gdprDisclaimer">
							Data Protection:  Marriott Vacation Club International is part of a global group of affiliated companies (“Affiliates”), and your personal information may be shared among the Affiliates and transferred outside of your country of residence.  Personal information that is transferred outside of the European Economic Area is done under data transfer agreements that contain standard data protection clauses adopted by the European Commission that provide safeguards for such transfers.  You may withdraw your consent to direct marketing at any time.  For more information about the use of your personal information and how to unsubscribe, please review our Global Privacy Statement found <a href="https://www.marriottvacationclub.com/privacy/#info" title="Privacy Statement">here</a> or contact our Privacy Office at <a href="mailto:privacy@mvw.com?subject=GDPR" "email me">privacy@mvw.com</a>.
						</p>
					</div>
					<div class="form-group" id="zipCodeFormGroup" style="display: none;">
						<label for="zipCodeInfoForm">Zip/Postal Code</label>
						<input type="text" class="form-control" name="addressPostalCode" id="zipCodeInfoForm" placeholder="" required>
						<div class='invalid-feedback' id='zipCodeError' style='display: none;'>
								Please provide a Zip Code before proceeding.
						</div>
					</div>
				</div>
				<div id='secondStepInfoForm' style='display: none;'>
					<div class="form-group">
					 <label for="phoneInfoForm">Phone</label>
					 <input type="text" class="form-control" name="daytimeTelephoneNumber" id="phoneInfoForm" aria-describedby="phoneNumber" placeholder="" required>
					 <div class='invalid-feedback' id='phoneInfoError' style='display: none;'>
								Please provide a phone number.
						</div>
				 </div>
				 <div class="form-group">
					 <label for="emailInfoForm">Email</label>
					 <input type="email" class="form-control" name="emailAddress" id="emailInfoForm" placeholder="" required>
					 <div class='invalid-feedback' id='emailInfoError' style='display: none;'>
								Please provide a valid Email address.
						</div>
				 </div>
				 <div class="form-check">
						<label class="form-check-label" id='electionFormCheck'>
							<input type="checkbox" name='optIn' class="form-check-input">
							YES, I want to receive by phone, email, and address I provided promotional information from Marriott Vacation Club International, regardless of any prior election to the contrary.
						</label>
					</div>
				</div>
				<input type="hidden" name="action" value="request_info_form">
			</form>
		</div>
HTML;
	}
?>
