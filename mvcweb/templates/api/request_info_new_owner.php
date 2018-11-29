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

$(function() {
	$.fn.serializeObject = function()
	{
	 var o = {};
	 var a = this.serializeArray();
	 $.each(a, function() {
	     if (o[this.name]) {
         if (!o[this.name].push) {
             o[this.name] = [o[this.name]];
         }
         o[this.name].push(this.value || '');
	     } else {
	         o[this.name] = this.value || '';
	     }
	 });
	 return o;
	};

	var isPromoForm = store.get('headerPromotionProspect') === 'firstStepProspect';
	
	var newOwnerStep = 1;
	var totalSteps = 2;
	var newOwnerStepTitle = $('#newOwnerStepTitle');
	var infoFormButton = $('#infoFormButton');
	var firstStepForm = $('#firstStepInfoForm');
	var secondStepForm = $('#secondStepInfoForm');
	var infoFormDescription = $('#infoFormDescription > p');
	var vacationExperienceBodyContent = $('#vacationExperiences');
	var thankYouProspectContent = $('#happensNext');
	var marriottQualityBodyContent = $('#marriottQuality');
	var infoForm = $('#requestInfoForm');
	var zipCodeFormGroup = $('#zipCodeFormGroup');
	var countryCodeSelect = $('#countryCodeSelect');
	
	var formId = 'DB59*1-H902S4';
	var emailValidationRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
	var phoneValidationRegex = /\d/g;

	infoForm.submit(function(e) {
		e.preventDefault();
		window.scrollTo(0,0);
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
		$.post(formActionUrl, objToSend);
	});

	var initialize = function() {
		thankYouProspectContent.hide();
		firstStepForm.hide();
		secondStepForm.hide();
		infoFormButton.click(handleFormClick);
		if(isPromoForm) {
			formId = 'DB59*1-I9ZF63';
			digitalData.pageInfo.formName="MVC - Request Information | Bonus Offer | Prospect"
			var image = $('.cover-picture-container').find('img');
			image.hide();
			$('.cover-picture-container').append($('<img>').addClass('content').on('load', function() {
					$(this).fadeIn();
				}).attr({
					src: <?php echo json_encode($GLOBALS['img_path'] . '201809/NewportCoastVillas02_1200x900.jpg');?>,
					alt: 'View of the main pool at Marriott\'s Newport Coast Villas in Newport Coast, California.'
			}));
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

var checkFieldsFirstStep = function() {
		var firstNameError = $('#firstNameError');
		var lastNameError = $('#lastNameError');
		var countrySelectError = $('#countrySelectError');
		
		if(!$('#firstNameInfoForm').val()) {
			firstNameError.show();
		} else {
			firstNameError.hide();
		}
		if(!$('#lastNameInfoForm').val()) {
			lastNameError.show();
		} else {
			lastNameError.hide();
		}
		if(!$('#countryCodeSelect').val()) {
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
				findZipCodeCityState(val);
			} else {
				$zipCodeError.show();
				$zipCodeInfoForm.focus()
			}
		}
	};

	var checkFieldsSecondStep = function() {
		var phoneInfoError = $('#phoneInfoError');
		var emailInfoError = $('#emailInfoError');
		if(!$('#phoneInfoForm').val() || !$('#phoneInfoForm').val().match(phoneValidationRegex)) {
			phoneInfoError.show();
		} else {
			phoneInfoError.hide();
		}
		if(!$('#emailInfoForm').val() || !$('#emailInfoForm').val().match(emailValidationRegex)) {
			emailInfoError.show();
		} else {
			emailInfoError.hide();
		}
	}

	countryCodeSelect.change(function(e) {
		var country = $(this).val().toUpperCase(),
			gdprCountries = "AUSTRIA|BELGIUM|BULGARIA|CROATIA|CZECH REPUBLIC|CYPRUS|DENMARK|ESTONIA|FINLAND|FRANCE|GERMANY|GREECE|HUNGARY|ICELAND|IRELAND|ITALY|LATVIA|LIECHTENSTEIN|LITHUANIA|LUXEMBOURG|MALTA|NETHERLANDS|NORWAY|POLAND|PORTUGAL|ROMANIA|SLOVAKIA|SLOVENIA|SPAIN|SWEDEN|UNITED KINGDOM";

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

	var haveFieldsError = function() {
		return $.makeArray($('.invalid-feedback')).some(function(element) {
			return $(element).is(':visible');
		});
	};

	var handleFormClick = function() {
		window.scrollTo(0,0);				
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
	};


	var firstStepNewOwnerForm = function() {
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

	var secondStepNewOwnerForm = function() {
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
		infoFormDescription.html('Almost done! Please provide your preferred phone number and email address and we will contact you.');
		newOwnerStepTitle.html('Step ' + newOwnerStep + ' of ' + totalSteps);
	};

		var finalStepNewOwnerForm = function() {
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
			infoFormDescription.html('We will be contacting you soon about your inquiry.<br><br>We appreciate your interest in Marriott Vacation Club and look forward to sharing more details about all the amazing places you can go and things you can do as an Owner.');
			newOwnerStepTitle.html('Thank you!');
			vacationExperienceBodyContent.hide();
			vacationExperienceBodyContent.next().hide();
			marriottQualityBodyContent.hide();
			thankYouProspectContent.show();
	};

	var manageStep = function() {
		var loc = getUrlParam('loc') || Cookies.get('loc') || 'DB59*1-H902RV';
		if (newOwnerStep === 1) {
			firstStepNewOwnerForm();
			setDataLayerRequestInfoPage(
				formId,
				loc,
				'Step 3: Request Information',
				'Prospect'
			);
			satelliteTrack(
				'step3: request info'
			);
		} else if (newOwnerStep === 2) {
			secondStepNewOwnerForm();
			setDataLayerRequestInfoPage(
				formId,
				loc,
				'Step 4: Request Information',
				'Prospect'
			);
			satelliteTrack(
				'step4: request info'
			);
		} else {
			finalStepNewOwnerForm();
			setDataLayerRequestInfoPage(
				formId,
				loc,
				'Step 5: Request Information',
				'Prospect'
			);
			digitalData.pageInfo.formSerial = getUniqueID();
			satelliteTrack(
				'step5: request info submit'
			);
		}
	};

	initialize();
	manageStep();
});

</script>
