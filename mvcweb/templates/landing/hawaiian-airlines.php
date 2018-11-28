<?php
	// Hawaiian Airlines
?>
<div class="hawaiian-airlines">
	<link rel='stylesheet' id='ha-css'  href='/wp-content/plugins/mvcweb/assets/mvcweb/css/ha.css?v=1' type='text/css' media='all' />
	<div class="ha-header-meta">
		Call <a href="tel:855-385-2312">855-385-2312</a>
		<a href="https://home-c20.incontact.com/incontact/chatclient/chatclient.aspx?poc=52dff431-cf38-461d-bf8c-59d9fafacfea&bu=4595893" title="Chat Now" class="marriott-btn" target="_blank">Chat Now</a>
	</div>
	<div class="container-fluid hero-element">
		<div class="row">
			<div class="col-xl-4">
				<div class="hero-element-info">
					<?php $actionURL = esc_url(admin_url('admin-post.php')); ?>
					<form class="ha-offer" id="haOffer" method="post" accept-charset="utf-8" action="<?php echo $actionURL; ?>">
						<input type="hidden" name="action" value="hawaiian_air_form">
						<input type='hidden' name='WorkQueueID' value='136'>
						<input type='hidden' name='MessageTemplateID' value='0'>
						<input type='hidden' name='MessageTypeID' value='120'>
						<input type='hidden' name='MessageStatusID' value='10'>
						<div class="ha-step ha-step--1" id="haStep1">
							<h1 class="hero-element-info-header">
								<img class="ha-logo" src="/wp-content/images/hawaiian-air/ha-logo.png" alt="Hawaiian Air">
							</h1>

							<div class="hero-element-info-body">
								<p>Earn 100 HawaiianMiles when you inquire about our special offers by entering your information below.</p>
								<p>Enjoy an unforgettable vacation.</p>

								<div class="form-group">
									<input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name" />
									<div class='invalid-feedback' id='firstNameError' style='display: none;'>
										Please enter your firstname.
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name" />
									<div class='invalid-feedback' id='lastNameError' style='display: none;'>
										Please enter your lastname.
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" name="haNumber" id="haNumber" placeholder="Hawaiian Airlines #" />
									<div class='invalid-feedback' id='haNumberError' style='display: none;'>
										Please enter your Hawaiian Airlines number.
									</div>
								</div>
								<button type="button" class="marriott-btn ha-next-step" id="haNextStep">Continue</button>
							</div><!-- / .hero-element-info-body -->
						</div><!-- / .ha-step--1 -->

						<div class="ha-step ha-step--2" id="haStep2">
							<h3 class="hero-element-info-header">
								Congratulations,<br />
								you've earned 100 HawaiianMiles!
							</h3>

							<div class="hero-element-info-body">
								<p>As a valued Hawaiian Airlines customer, you have been selected to receive a special offer from Marriott Vacation Club<sup>&reg;</sup>. For details, please provide your information below.</p>

								<div class="form-group">
									<input class="form-control" type="email" name="emailAddress" value="" id="emailAddress" placeholder="Email Address">
									<div class='invalid-feedback' id='emailInfoError' style='display: none;'>
										Please enter a valid email address.
									</div>
								</div>

								<fieldset>
									<legend>Income</legend>
									<div class="form-check">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" name="haIncome" value="50k" checked />
											$50,000 &ndash; $75,000
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" name="haIncome" value="75k" />
											$75,000 &ndash; $100,000
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" name="haIncome" value="100k" />
											$100,000+
										</label>
									</div>
								</fieldset>
								
								<button type="submit" class="marriott-btn ha-submit">Get Details</button>
							</div><!-- / .hero-element-info-body -->
						</div><!-- / .ha-step--2 -->
					</form>
				</div><!-- / .hero-element-info -->
			</div>
			<div class="col-xl-8 cover-picture-container">
				<img class="content" src="/wp-content/images/hawaiian-air/ha-hero-1.jpg"></img>
			</div><!--  / .cover-picture-container -->
		</div><!--  / .row -->
	</div><!--  / .hero-element -->
	<script>
		(function(){
			$('.hawaiian-airlines .ha-header-meta').appendTo('.navbar')
		})();

		var haveFieldsError = function() {
			return $.makeArray($('.invalid-feedback')).some(function(element) {
				return $(element).is(':visible');
			});
		};

		var checkFieldsFirstStep = function() {
			var firstNameError = $('#firstNameError'),
				lastNameError = $('#lastNameError'),
				haNumberError = $('#haNumberError');

			if(!$('#firstName').val()) {
				firstNameError.show();
			} else {
				firstNameError.hide();
			}
			if(!$('#lastName').val()) {
				lastNameError.show();
			} else {
				lastNameError.hide();
			}
			if(!$('#haNumber').val()) {
				haNumberError.show();
			} else {
				haNumberError.hide();
			}

			if(!haveFieldsError()) {
				$('#haStep1').hide();
				$('#haStep2').show();
			}
		};

		var callSubmittedEntrySuccess = function() {
			var haIncome = $('input[name=haIncome]:checked').val(),
				formId = 'DB59*1-H902S4';

			if( "50k" === haIncome ) {
				window.location.replace("/landing/ha-special-offer/");
			} else if( "75k" === haIncome || "100k" === haIncome ) {
				window.location.replace("/landing/ha-extra-special-offer/");
			}
		}


		var onSubmit = function (event) {
			event.preventDefault();

			var haEmail = $('#emailAddress').val(),
				emailValidationRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
				emailInfoError = $('#emailInfoError'),
				haIncome = $('input[name=haIncome]:checked').val(),
				formId = 'DB59*1-H902S4';

			if(!haEmail || !haEmail.match(emailValidationRegex)) {
				emailInfoError.show();
			} else {
				emailInfoError.hide();
			}

			if(!haveFieldsError()) {
				// AJAXy stuff goes here?

				var formActionUrl = $(this).attr('action'),
					messageTypeID = "need message type ID",
					workQueueID = "need work queue ID",
					loc = "need-loc", // getUrlParam('loc') || Cookies.get('loc') || 'DB59*1-H902RV';
					objToSend = $(this).serializeObject();
					objToSend.messageTypeID = messageTypeID;
					objToSend.workQueueID = workQueueID;
					objToSend.formId = formId;
				
				if (loc) {
					objToSend.originLOC = loc;
				}
				
				$.post(formActionUrl, objToSend);
				setDataLayerGenericPage("MVC - Landing", "MVC - Landing | Hawaiian Airlines");
				digitalData.pageInfo.formName = "need-form-name" // "MVC - Request Information | Bonus Offer | Owner Purchase";
				// digitalData.pageInfo.formSerial = getUniqueID();

				if( "50k" === haIncome ) {
					window.location.replace("/landing/ha-special-offer/");
				} else if( "75k" === haIncome || "100k" === haIncome ) {
					window.location.replace("/landing/ha-extra-special-offer/");
				}
			}
		}

		$('#haNextStep').click( checkFieldsFirstStep );
		$('#haOffer').submit( event, onSubmit )
	</script>
	<?php // This snippet adds an embeded Live Chat button
		/*
			<script type = "text/javascript" src = 'https://home-c20.incontact.com/inContact/ChatClient/js/embed.min.js'></script>
			<script type ="text/javascript">
			icPatronChat.init({serverHost:'https://home-c20.incontact.com',bus_no:4595893,poc:'b075fb94-3eaf-4be7-99f2-4b8ea3f5b0a5',params:['FirstName','Last Name','first.last@company.com',555-555-5555]});
			</script>
		*/
	?>
</div><!--  / .hawaiian-airlines -->
