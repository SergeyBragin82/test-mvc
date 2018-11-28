<script>
	var isGmapsInit = false,
		zipCodeTriggered = false,
		city,
		state,
		$zipCodeInfoForm = $('#zipCodeInfoForm'),
		$zipCodeError = $('#zipCodeError');

	function gMapsInit() {
		var isGmapsInit = true;
		
		if ($zipCodeInfoForm.is(':visible') && $zipCodeInfoForm.val() !== '' && !zipCodeTriggered) {
			findZipCodeCityState($zipCodeInfoForm.val());
		}
	}

	function findZipCodeCityState(zipCode) {
		$zipCodeError.hide();
		var geo = new google.maps.Geocoder();
		
		geo.geocode({
			'address': zipCode
		}, function(results, status) {

			<?php // Check if Google returned an OK status ?>
			if ("ZERO_RESULTS" === status) {
				$zipCodeError.show();
				$zipCodeInfoForm.focus()

			} else if (google.maps.GeocoderStatus.OK === status) {

				<?php // Iterate thru results array, return true if it has types: ["postal_code"]  ?>
				var onlyPostalType = results.filter( function(result) {
					if( result.types.length ) {
						return result.types[0] === 'postal_code';
					} else {
						return false;
					}
				});

				<?php // If the above returned true, get the first element of array ?>
				if ( onlyPostalType.length ) {
					var found = onlyPostalType[0];
					
					if (found) {
						
						<?php // Iterate thru elements address_components element to capture city/state ?>
						found.address_components.forEach(function(component) {
							if (component.types.indexOf('locality') >= 0) {
								city = component['long_name'];
							} else if (component.types.indexOf('administrative_area_level_1') >= 0) {
								state = component['short_name'];
							}
						});
					} else {
						$zipCodeError.show();
						$zipCodeInfoForm.focus()
					}
				} else {
					$zipCodeError.show();
					$zipCodeInfoForm.focus()
				}
			}
		});
	}

	$(function () {
		
		var isPromoForm = store.get('headerPromotionOwner') === 'firstStepOwner';
		var newOwnerStep = 0;
		var totalSteps = 2;
		var newOwnerStepTitle = $('#newOwnerStepTitle');
		var infoFormButton = $('#infoFormButton');
		var firstStepForm = $('#firstStepInfoForm');
		var secondStepForm = $('#secondStepInfoForm');
		var infoFormDescription = $('#infoFormDescription > p');
		var vacationExperienceBodyContent = $('#vacationExperiences');
		var ownerTipBodyContent = $('#ownerTipsResources');
		var marriottQualityBodyContent = $('#marriottQuality');
		var infoForm = $('#requestInfoForm');
		var ownerOptions = $('#requestInfoOwnerOptions');
		var zipCodeFormGroup = $('#zipCodeFormGroup');
		var countryCodeSelect = $('#countryCodeSelect');
		var formId = '';
		var emailValidationRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
		var phoneValidationRegex = /\d/g;
		var messageTypeID = 120;
		var workQueueID = 136;

		infoForm.submit(function (e) {
			e.preventDefault();
			window.scrollTo(0, 0);
			var formActionUrl = $(this).attr('action');
			var objToSend = $(this).serializeObject();
			objToSend.formUrl = window.location.href;
			objToSend.optIn = objToSend.optIn === 'on' ? 'true' : 'false';
			objToSend.formId = formId;
			var loc = getUrlParam('loc') || Cookies.get('loc') || 'DB59*1-H902RV';
			if (loc) {
				objToSend.originLOC = loc;
			}
			if (city) {
				objToSend.addressCity = city;
			}
			if (state) {
				objToSend.addressStateProvince = state;
			}
			objToSend.messageTypeID = messageTypeID;
			objToSend.workQueueID = workQueueID;
			$.post(formActionUrl, objToSend);
			digitalData.pageInfo.formSerial = getUniqueID();
		});

		var initialize = function () {
			ownerTipBodyContent.hide();
			ownerOptions.show();
			showOwnerOptions();
			satelliteTrack('step2: request info');
			infoFormButton.click(handleFormClick);
			
			if(isPromoForm) {
				formId = "DB59*1-I9ZF69";
				digitalData.pageInfo.formName = "MVC - Request Information | Bonus Offer | Owner Purchase";
				var image = $('.cover-picture-container').find('img');
				image.hide();
				$('.cover-picture-container').append($('<img>').addClass('content').on('load', function() {
					$(this).fadeIn();
				}).attr({
					src: <?php echo json_encode($GLOBALS['img_path'] . '201809/NewportCoastVillas02_1200x900.jpg');?>,
					alt: 'View of the main pool at Marriott\'s Newport Coast Villas in Newport Coast, California.'
				}));
				ownerOptions.hide();
				$('#ownerSelectionError').hide();
				newOwnerStep++;
				manageStep();
			}

			$zipCodeInfoForm.blur(function() {
				var zip = $(this).val();
				if (!zip) return;
				if (isGmapsInit) {
					zipCodeTriggered = true;
					findZipCodeCityState(zip);
				}
			});
		};

		var toggleErrorFeedback = function (selector) {
			$(selector).toggle();
		};

		var haveFieldsError = function () {
			return $.makeArray($('.invalid-feedback')).some(function (element) {
				return $(element).is(':visible');
			});
		};

		var handleFormClick = function () {
			window.scrollTo(0, 0);
			if (newOwnerStep === 0) {
				var options = $('input[name=ownerSelection]');
				var ownerSelection = $.makeArray(options).some(function (element) {
					return $(element).prop('checked') === true;
				});
				if (ownerSelection) {
					var checkedElement = $('input[name=ownerSelection]:checked');
					if (checkedElement.is(options.get(0))) {
						formId = 'DB59*1-H902S1';
						digitalData.pageInfo.formName = "MVC - Request Information | Main | Owner Purchase";
					} else if (checkedElement.is(options.get(1))) {
						formId = 'IM59*1-H902SD';
						digitalData.pageInfo.formName = "MVC - Request Information | Main | Owner Services";
						messageTypeID = 150;
						workQueueID = 102;
					}
					ownerOptions.hide();
					$('#ownerSelectionError').hide();
					newOwnerStep++;
					manageStep();
				} else {
					$('#ownerSelectionError').show();
				}
			} else {
				
				if ( newOwnerStep === 1 )
					checkFieldsFirstStep();
				
				if ( newOwnerStep === 2 )
					checkFieldsSecondStep();
				
				<?php // Giving Geocoder a second to return results ?>
				setTimeout( function () {
					if ( !haveFieldsError() ) {
						newOwnerStep++;
						manageStep();
					}
				}, 500 );
			}
		};

		countryCodeSelect.change(function (e) {
			var country = $(this).val().toUpperCase(),
				gdprCountries = "AUSTRIA|BELGIUM|BULGARIA|CROATIA|CZECH REPUBLIC|DENMARK|ESTONIA|FINLAND|FRANCE|GERMANY|GREECE|HUNGARY|ICELAND|IRELAND|ITALY|LATVIA|LIECHTENSTEIN|LITHUANIA|LUXEMBOURG|MALTA|NETHERLANDS|NORWAY|POLAND|PORTUGAL|ROMANIA|SLOVAKIA|SLOVENIA|SPAIN|SWEDEN|UNITED KINGDOM";

			if(country === 'UNITED STATES' || country === 'CANADA') {
				zipCodeFormGroup.show();
			} else {
				zipCodeFormGroup.hide();
			}
				
			if ( 0 <= gdprCountries.indexOf( country ) ) {
				$('#gdprDisclaimer').show();
			} else {
				$('#gdprDisclaimer').hide();
			}
		});

		var showOwnerOptions = function () {
			infoFormDescription.html(
				'Tell us a little more about what you would like to learn or do with your Ownership? Please select from the list below.'
			);
			newOwnerStepTitle.html('Help Us To Get To Know You');
		}

		var checkFieldsFirstStep = function () {
			var firstNameError = $('#firstNameError');
			var lastNameError = $('#lastNameError');
			var countrySelectError = $('#countrySelectError');

			if (!$('#firstNameInfoForm').val()) {
				firstNameError.show();
			} else {
				firstNameError.hide();
			}
			if (!$('#lastNameInfoForm').val()) {
				lastNameError.show();
			} else {
				lastNameError.hide();
			}
			if (!$('#countryCodeSelect').val()) {
				countrySelectError.show();
			} else {
				countrySelectError.hide();
			}
			if ($zipCodeInfoForm.is(':visible')) {
				var val = $zipCodeInfoForm.val();

				// If zip includes 4-digit code and no dash, insert dash so APIcan properly parse
				if(9 === val.length) {
					val = val.substring(0, 5) + '-' + val.substring(5);
					$zipCodeInfoForm.val(val);
				}
				
				if (val && val.length >= 5 ) {
					$zipCodeError.hide();
					findZipCodeCityState($zipCodeInfoForm.val());
				} else {
					$zipCodeError.show();
					$zipCodeInfoForm.focus()
				}
			}
		};

		var checkFieldsSecondStep = function () {
			var phoneInfoError = $('#phoneInfoError');
			var emailInfoError = $('#emailInfoError');
			if (!$('#phoneInfoForm').val() || !$('#phoneInfoForm').val().match(phoneValidationRegex)) {
				phoneInfoError.show();
			} else {
				phoneInfoError.hide();
			}
			if (!$('#emailInfoForm').val() || !$('#emailInfoForm').val().match(emailValidationRegex)) {
				emailInfoError.show();
			} else {
				emailInfoError.hide();
			}
		}

		var firstStepOwnerForm = function () {
			firstStepForm.show();
			secondStepForm.hide();
			if(!isPromoForm) {
				infoFormDescription.html(
				'Interested in learning more about Marriott Vacation Club? Share a few details to send us a message.');
			} else {
				infoFormDescription.html(
				'Please just take a moment or two and answer these questions.');
			}

			newOwnerStepTitle.html('Step ' + newOwnerStep + ' of ' + totalSteps);
			vacationExperienceBodyContent.show();
			marriottQualityBodyContent.show();

		}

		var secondStepOwnerForm = function () {
			if(isPromoForm) {
				var image = $('.cover-picture-container').find('img');
				image.hide();
				$('.cover-picture-container').append($('<img>').addClass('content').on('load', function() {
					$(this).fadeIn();
				}).attr({
					src: <?php echo json_encode($GLOBALS['img_path'] . '201809/NewportCoastVillas02_1200x900.jpg');?>,
					alt: 'View of the main pool at Marriott\'s Newport Coast Villas in Newport Coast, California.'
				}));
			}
			firstStepForm.hide();
			secondStepForm.show();
			infoFormDescription.html(
				'Almost done! Please provide your preferred phone number and email address and we will contact you.');
			newOwnerStepTitle.html('Step ' + newOwnerStep + ' of ' + totalSteps);
		};

		var finalStepOwnerForm = function () {
			infoForm.submit();
			if(isPromoForm) {
				var image = $('.cover-picture-container').find('img');
				image.hide();
				$('.cover-picture-container').append($('<img>').addClass('content').on('load', function() {
					$(this).fadeIn();
				}).attr({
					src: <?php echo json_encode($GLOBALS['img_path'] . '201809/GrandeVista01_1200x900.jpg');?>,
					alt: 'View of the main pool at Marriott\'s Grande Vista, Orlando, Florida.'
				}));
				clearPromoFormStore();
			}
			firstStepForm.hide();
			secondStepForm.hide();
			infoFormButton.hide();
			infoFormDescription.html(
				'We will be contacting you soon about your inquiry.<br><br>Marriott Vacation Club is dedicated to helping you live the vacation lifestyle and maximizing your Ownership.  Below are helpful tips and resource links to assist you in vacationing like a pro.'
			);
			newOwnerStepTitle.html('Thank you!');
			vacationExperienceBodyContent.hide();
			vacationExperienceBodyContent.next().hide();
			marriottQualityBodyContent.hide();
			ownerTipBodyContent.show();
		};

		var manageStep = function () {
			var loc = getUrlParam('loc') || Cookies.get('loc') || 'DB59*1-H902RV';
			if (newOwnerStep === 1) {
				firstStepOwnerForm();
				setDataLayerRequestInfoPage(
					formId,
					loc,
					'Step 3: Request Information',
					'Owner'
				);
				satelliteTrack(
					'step3: request info'
				);
			} else if (newOwnerStep === 2) {
				secondStepOwnerForm();
				setDataLayerRequestInfoPage(
					formId,
					loc,
					'Step 4: Request Information',
					'Owner'
				);
				satelliteTrack(
					'step4: request info'
				);
			} else {
				finalStepOwnerForm();
				setDataLayerRequestInfoPage(
					formId,
					loc,
					'Step 5: Request Information',
					'Owner'
				);
				satelliteTrack(
					'step5: request info submit'
				);
			}
		};
		initialize();
	});
</script>
