<?php
	// Using styling from Hawaiian Airlines landing pages
?>
<div class="hawaiian-airlines">
	<link rel='stylesheet' id='ha-css'  href='/wp-content/plugins/mvcweb/assets/mvcweb/css/ha.css?v=1' type='text/css' media='all' />
	<div class="ha-header-meta">
		<h6 style="font-weight: bold; letter-spacing: 3px; margin-top: 40px;">FOR MORE INFORMATION CALL <a href="tel:800-307-7312">800-307-7312</a></h6>
	</div>
	<div class="container-fluid hero-element">
		<div class="row">
			<div class="col-xl-8 cover-picture-container" style="position: relative; top: 0;">
				<img src="/wp-content/images/201809/1200x900_NewYork_1.jpg" style="position: absolute; top: 0;" alt="New York City"></img>
			</div><!--  / .cover-picture-container -->
			<div class="col-xl-4">
				<div class="hero-element-info">
					<?php $actionURL = esc_url(admin_url('admin-post.php')); ?>
					<form id="request_information_right" method="post" accept-charset="utf-8" action="<?php echo $actionURL; ?>">
						<input type="hidden" name="action" value="request_information_right">
						<input type='hidden' name='WorkQueueID' value='136'>
						<input type='hidden' name='MessageTemplateID' value='0'>
						<input type='hidden' name='MessageTypeID' value='120'>
						<input type='hidden' name='MessageStatusID' value='10'>
						<div>
							<h1 class="hero-element-info-header">
								Request Information
							</h1>

							<div class="hero-element-info-body">
								<p>Simply complete the form below and a Marriott Vacation Club representative will contact you within 2 business days</p>
								<h6 style="color: #009687; padding: 10px 0; font-weight: bold; letter-spacing: 3px;">ALL FIELDS REQUIRED</h6>
								<div class="form-group">
									<select class="form-control" id="memberStatus" name="memberStatus" required="">
										<option value="" style="display: none;" selected="">Are you a Marriott Vacation Club Owner?</option>
									    <option value="Yes">Yes</option>
									    <option value="No">No</option>
									</select>
									<div class="invalid-feedback" id="memberStatusError" style="display: none;">
										You must specify your membership status before proceeding.
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name" />
									<div class='invalid-feedback' id='firstNameError' style='display: none;'>
										Please enter your first name.
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name" />
									<div class='invalid-feedback' id='lastNameError' style='display: none;'>
										Please enter your last name.
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" name="email" id="email" placeholder="Email" />
									<div class='invalid-feedback' id='emailError' style='display: none;'>
										Please enter your email.
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" name="phone" id="phone" placeholder="Phone" />
									<div class='invalid-feedback' id='phoneError' style='display: none;'>
										Please enter your phone number.
									</div>
								</div>
								<div class="form-group">
									<select class="form-control" id="addressCountryCode" name="addressCountryCode" required="">
										<option value="" selected="">Country/Region</option>
									    <option value="United States">United States</option>
									    <option value="Afghanistan">Afghanistan</option>
									    <option value="Albania">Albania</option>
									    <option value="Algeria">Algeria</option>
									    <option value="American Samoa">American Samoa</option>
									    <option value="Andorra">Andorra</option>
									    <option value="Angola">Angola</option>
									    <option value="Anguilla">Anguilla</option>
									    <option value="Antartica">Antarctica</option>
									    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
									    <option value="Argentina">Argentina</option>
									    <option value="Armenia">Armenia</option>
									    <option value="Aruba">Aruba</option>
									    <option value="Australia">Australia</option>
									    <option value="Austria">Austria</option>
									    <option value="Azerbaijan">Azerbaijan</option>
									    <option value="Bahamas">Bahamas</option>
									    <option value="Bahrain">Bahrain</option>
									    <option value="Bangladesh">Bangladesh</option>
									    <option value="Barbados">Barbados</option>
									    <option value="Belarus">Belarus</option>
									    <option value="Belgium">Belgium</option>
									    <option value="Belize">Belize</option>
									    <option value="Benin">Benin</option>
									    <option value="Bermuda">Bermuda</option>
									    <option value="Bhutan">Bhutan</option>
									    <option value="Bolivia">Bolivia</option>
									    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
									    <option value="Botswana">Botswana</option>
									    <option value="Bouvet Island">Bouvet Island</option>
									    <option value="Brazil">Brazil</option>
									    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
									    <option value="Brunei Darussalam">Brunei Darussalam</option>
									    <option value="Bulgaria">Bulgaria</option>
									    <option value="Burkina Faso">Burkina Faso</option>
									    <option value="Burundi">Burundi</option>
									    <option value="Cambodia">Cambodia</option>
									    <option value="Cameroon">Cameroon</option>
									    <option value="Canada">Canada</option>
									    <option value="Cape Verde">Cape Verde</option>
									    <option value="Cayman Islands">Cayman Islands</option>
									    <option value="Central African Republic">Central African Republic</option>
									    <option value="Chad">Chad</option>
									    <option value="Chile">Chile</option>
									    <option value="China">China</option>
									    <option value="Christmas Island">Christmas Island</option>
									    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
									    <option value="Colombia">Colombia</option>
									    <option value="Comoros">Comoros</option>
									    <option value="Congo">Congo</option>
									    <option value="Congo">Congo, the Democratic Republic of the</option>
									    <option value="Cook Islands">Cook Islands</option>
									    <option value="Costa Rica">Costa Rica</option>
									    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
									    <option value="Croatia">Croatia (Hrvatska)</option>
									    <option value="Cuba">Cuba</option>
									    <option value="Cyprus">Cyprus</option>
									    <option value="Czech Republic">Czech Republic</option>
									    <option value="Denmark">Denmark</option>
									    <option value="Djibouti">Djibouti</option>
									    <option value="Dominica">Dominica</option>
									    <option value="Dominican Republic">Dominican Republic</option>
									    <option value="East Timor">East Timor</option>
									    <option value="Ecuador">Ecuador</option>
									    <option value="Egypt">Egypt</option>
									    <option value="El Salvador">El Salvador</option>
									    <option value="Equatorial Guinea">Equatorial Guinea</option>
									    <option value="Eritrea">Eritrea</option>
									    <option value="Estonia">Estonia</option>
									    <option value="Ethiopia">Ethiopia</option>
									    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
									    <option value="Faroe Islands">Faroe Islands</option>
									    <option value="Fiji">Fiji</option>
									    <option value="Finland">Finland</option>
									    <option value="France">France</option>
									    <option value="France Metropolitan">France, Metropolitan</option>
									    <option value="French Guiana">French Guiana</option>
									    <option value="French Polynesia">French Polynesia</option>
									    <option value="French Southern Territories">French Southern Territories</option>
									    <option value="Gabon">Gabon</option>
									    <option value="Gambia">Gambia</option>
									    <option value="Georgia">Georgia</option>
									    <option value="Germany">Germany</option>
									    <option value="Ghana">Ghana</option>
									    <option value="Gibraltar">Gibraltar</option>
									    <option value="Greece">Greece</option>
									    <option value="Greenland">Greenland</option>
									    <option value="Grenada">Grenada</option>
									    <option value="Guadeloupe">Guadeloupe</option>
									    <option value="Guam">Guam</option>
									    <option value="Guatemala">Guatemala</option>
									    <option value="Guinea">Guinea</option>
									    <option value="Guinea-Bissau">Guinea-Bissau</option>
									    <option value="Guyana">Guyana</option>
									    <option value="Haiti">Haiti</option>
									    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
									    <option value="Holy See">Holy See (Vatican City State)</option>
									    <option value="Honduras">Honduras</option>
									    <option value="Hong Kong">Hong Kong</option>
									    <option value="Hungary">Hungary</option>
									    <option value="Iceland">Iceland</option>
									    <option value="India">India</option>
									    <option value="Indonesia">Indonesia</option>
									    <option value="Iran">Iran (Islamic Republic of)</option>
									    <option value="Iraq">Iraq</option>
									    <option value="Ireland">Ireland</option>
									    <option value="Israel">Israel</option>
									    <option value="Italy">Italy</option>
									    <option value="Jamaica">Jamaica</option>
									    <option value="Japan">Japan</option>
									    <option value="Jordan">Jordan</option>
									    <option value="Kazakhstan">Kazakhstan</option>
									    <option value="Kenya">Kenya</option>
									    <option value="Kiribati">Kiribati</option>
									    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
									    <option value="Korea">Korea, Republic of</option>
									    <option value="Kuwait">Kuwait</option>
									    <option value="Kyrgyzstan">Kyrgyzstan</option>
									    <option value="Lao">Lao People's Democratic Republic</option>
									    <option value="Latvia">Latvia</option>
									    <option value="Lebanon">Lebanon</option>
									    <option value="Lesotho">Lesotho</option>
									    <option value="Liberia">Liberia</option>
									    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
									    <option value="Liechtenstein">Liechtenstein</option>
									    <option value="Lithuania">Lithuania</option>
									    <option value="Luxembourg">Luxembourg</option>
									    <option value="Macau">Macau</option>
									    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
									    <option value="Madagascar">Madagascar</option>
									    <option value="Malawi">Malawi</option>
									    <option value="Malaysia">Malaysia</option>
									    <option value="Maldives">Maldives</option>
									    <option value="Mali">Mali</option>
									    <option value="Malta">Malta</option>
									    <option value="Marshall Islands">Marshall Islands</option>
									    <option value="Martinique">Martinique</option>
									    <option value="Mauritania">Mauritania</option>
									    <option value="Mauritius">Mauritius</option>
									    <option value="Mayotte">Mayotte</option>
									    <option value="Mexico">Mexico</option>
									    <option value="Micronesia">Micronesia, Federated States of</option>
									    <option value="Moldova">Moldova, Republic of</option>
									    <option value="Monaco">Monaco</option>
									    <option value="Mongolia">Mongolia</option>
									    <option value="Montserrat">Montserrat</option>
									    <option value="Morocco">Morocco</option>
									    <option value="Mozambique">Mozambique</option>
									    <option value="Myanmar">Myanmar</option>
									    <option value="Namibia">Namibia</option>
									    <option value="Nauru">Nauru</option>
									    <option value="Nepal">Nepal</option>
									    <option value="Netherlands">Netherlands</option>
									    <option value="Netherlands Antilles">Netherlands Antilles</option>
									    <option value="New Caledonia">New Caledonia</option>
									    <option value="New Zealand">New Zealand</option>
									    <option value="Nicaragua">Nicaragua</option>
									    <option value="Niger">Niger</option>
									    <option value="Nigeria">Nigeria</option>
									    <option value="Niue">Niue</option>
									    <option value="Norfolk Island">Norfolk Island</option>
									    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
									    <option value="Norway">Norway</option>
									    <option value="Oman">Oman</option>
									    <option value="Pakistan">Pakistan</option>
									    <option value="Palau">Palau</option>
									    <option value="Panama">Panama</option>
									    <option value="Papua New Guinea">Papua New Guinea</option>
									    <option value="Paraguay">Paraguay</option>
									    <option value="Peru">Peru</option>
									    <option value="Philippines">Philippines</option>
									    <option value="Pitcairn">Pitcairn</option>
									    <option value="Poland">Poland</option>
									    <option value="Portugal">Portugal</option>
									    <option value="Puerto Rico">Puerto Rico</option>
									    <option value="Qatar">Qatar</option>
									    <option value="Reunion">Reunion</option>
									    <option value="Romania">Romania</option>
									    <option value="Russia">Russian Federation</option>
									    <option value="Rwanda">Rwanda</option>
									    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
									    <option value="Saint LUCIA">Saint LUCIA</option>
									    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
									    <option value="Samoa">Samoa</option>
									    <option value="San Marino">San Marino</option>
									    <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
									    <option value="Saudi Arabia">Saudi Arabia</option>
									    <option value="Senegal">Senegal</option>
									    <option value="Seychelles">Seychelles</option>
									    <option value="Sierra">Sierra Leone</option>
									    <option value="Singapore">Singapore</option>
									    <option value="Slovakia">Slovakia (Slovak Republic)</option>
									    <option value="Slovenia">Slovenia</option>
									    <option value="Solomon Islands">Solomon Islands</option>
									    <option value="Somalia">Somalia</option>
									    <option value="South Africa">South Africa</option>
									    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
									    <option value="Spain">Spain</option>
									    <option value="SriLanka">Sri Lanka</option>
									    <option value="St. Helena">St. Helena</option>
									    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
									    <option value="Sudan">Sudan</option>
									    <option value="Suriname">Suriname</option>
									    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
									    <option value="Swaziland">Swaziland</option>
									    <option value="Sweden">Sweden</option>
									    <option value="Switzerland">Switzerland</option>
									    <option value="Syria">Syrian Arab Republic</option>
									    <option value="Taiwan">Taiwan</option>
									    <option value="Tajikistan">Tajikistan</option>
									    <option value="Tanzania">Tanzania, United Republic of</option>
									    <option value="Thailand">Thailand</option>
									    <option value="Togo">Togo</option>
									    <option value="Tokelau">Tokelau</option>
									    <option value="Tonga">Tonga</option>
									    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
									    <option value="Tunisia">Tunisia</option>
									    <option value="Turkey">Turkey</option>
									    <option value="Turkmenistan">Turkmenistan</option>
									    <option value="Turks and Caicos">Turks and Caicos Islands</option>
									    <option value="Tuvalu">Tuvalu</option>
									    <option value="Uganda">Uganda</option>
									    <option value="Ukraine">Ukraine</option>
									    <option value="United Arab Emirates">United Arab Emirates</option>
									    <option value="United Kingdom">United Kingdom</option>
									    <option value="Uruguay">Uruguay</option>
									    <option value="Uzbekistan">Uzbekistan</option>
									    <option value="Vanuatu">Vanuatu</option>
									    <option value="Venezuela">Venezuela</option>
									    <option value="Vietnam">Viet Nam</option>
									    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
									    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
									    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
									    <option value="Western Sahara">Western Sahara</option>
									    <option value="Yemen">Yemen</option>
									    <option value="Yugoslavia">Yugoslavia</option>
									    <option value="Zambia">Zambia</option>
		    							<option value="Zimbabwe">Zimbabwe</option>
									</select>
									<div class='invalid-feedback' id='addressCountryCodeError' style='display: none;'>
										Please enter your country/region.
									</div>
								</div>
								<div class="form-group">
									<div id="showComment" style="text-decoration: none; cursor: pointer;"><i class="icon-plus" aria-hidden="true" style="color: #009687; font-size: 0.75em;"></i> Add Comment</div>
									<textarea class="form-control hidden" id="comment" name="comment" style="display: none;"></textarea>
								</div>
								<div class="form-group">
									<input type="checkbox" name="infoOptIn" id="infoOptIn" style="float: left; margin-top: 5px; width: 22px; height: 22px;"><div style="margin-left: 32px;"><strong>Yes</strong>, I would like to receive (by above address, phone, or email) information about promotions from Marriott Vacation Club, regardless of any prior election to the contrary.</div>
								</div>
								<button type="submit" class="marriott-btn ha-submit">Submit</button>
							</div><!-- / .hero-element-info-body -->
						</div>
					</form>
				</div><!-- / .hero-element-info -->
			</div>
		</div><!--  / .row -->
		<div class="break"><hr></div>
		<div class="row" style="padding: 32px;">
			<div class="col-xl-5">
				<h6 style="color: #009687; padding: 10px 0; font-weight: bold; letter-spacing: 3px;">MARRIOTT VACATION CLUB</h6>
				<h1>Timeshare at its Best.</h1>
				<p>WIth more than 30 years of experience, Marriott Vacation Club<sup>&reg;</sup> is the leader in Timeshare Ownership. And today, Marriott Vacation Club offers the ultimate in vacation flexibility with a deeded, points-based ownership program providing you with everything from resorts and hotels to safaris and cruises.</p>
				<h6 style="color: #009687; padding: 10px 0; font-weight: bold; letter-spacing: 3px;">DISCOVER THE BENEFITS OF OWNERSHIP</h6>
				<p>Through ownership in the Marriott Vacation Club Destinations&trade; Ownership Program, you may use your annual Vacation Club Points to enjoy weeks of vacation in luxurious destinations. You can also use them for weekend getaways and other vacation experiences. It's completely flexible - you decide where and how to want to vacation.</p>
			</div>
			<div class="col-xl-5 offset-md-2">
				<h6 style="color: #009687; padding: 10px 0; font-weight: bold; letter-spacing: 3px;">AS AN OWNER, ENJOY ACCESS TO A VARIETY OF REMARKABLE VACATION EXPERIENCES INCLUDING:</h6>
				<div style="background-color: #159486; height: 7px; width: 44px; top: -1px; left: 1rem;"></div>
				<ul style="padding-top: 32px;">
					<li><h6 style="font-weight: bold;">MORE THAN 50 MARRIOTT VACATION CLUB RESORTS</h6></li>
					<li><h6 style="font-weight: bold;">MORE THAN 6,500 MARRIOTT<sup>&reg;</sup> HOTELS AND RESORTS</h6></li>
					<li><h6 style="font-weight: bold;">SPECIALTY TRAVEL OPTIONS INCLUDING SAFARIS, WINE TOURS AND CRUISES</h6></li>
					<li><h6 style="font-weight: bold;">3,000+ AFFILIATED RESORTS IN DOZENS OF COUNTRIES</h6></li>
				</ul>
			</div>
		</div><!--  / .row -->
		<div class="row" style="padding: 32px; position: relative;">
			<div class="col-xl-12">
				<h6 style="color: #009687; padding: 10px 0; font-weight: bold; letter-spacing: 3px; text-align: center;">TO GET STARTED, CONTACT US FOR PROGRAM DETAILS AND<br>A CUSTOMIZED OWNERSHIP PROPOSAL THAT'S RIGHT FOR YOU.</h6>
			</div>
			<div style="position: absolute; bottom: 0; right: 0; padding: 10px 25px;">MDC-18-294</div>
		</div><!--  / .row -->
	</div><!--  / .hero-element -->
	<script>
		/* Dynamic phone number */
		var urlParams = new URLSearchParams(window.location.search);
		var formLOC = urlParams.get('LOC');
		var formSerial = getUniqueID();

		switch (formLOC) {
			case "DB59*1-J9RZ8G":
				$(".ha-header-meta h6 a").attr("href", "tel:866-259-6394").html("866-259-6394");
				break;

			case "DB59*1-J9RZ8J":
				$(".ha-header-meta h6 a").attr("href", "tel:866-363-8213").html("866-363-8213");
				break;

			case "DB59*1-J9RZ8M":
				$(".ha-header-meta h6 a").attr("href", "tel:888-516-5490").html("888-516-5490");
				break;

			case "DB59*1-J9RZ8Z":
				$(".ha-header-meta h6 a").attr("href", "tel:866-389-1467").html("866-389-1467");
				break;

			case "DB59*1-J9RZ92":
				$(".ha-header-meta h6 a").attr("href", "tel:800-983-4199").html("800-983-4199");
				break;

			case "DB59*1-J9RZ95":
				$(".ha-header-meta h6 a").attr("href", "tel:800-445-0375").html("800-445-0375");
				break;

			case "DB59*1-J9RZ9B":
				$(".ha-header-meta h6 a").attr("href", "tel:800-983-4234").html("800-983-4234");
				break;

			case "DB59*1-J9RZ9E":
				$(".ha-header-meta h6 a").attr("href", "tel:866-468-2447").html("866-468-2447");
				break;

			default:
				$(".ha-header-meta h6 a").attr("href", "tel:800-307-7312").html("800-307-7312");		
		}

		var pageLang = $('html').attr('lang');

		digitalData = {
			pageInfo: {
				pageName: "MVC - Landing Pages | PPC | CSD | Test 2",
				siteSection: "MVC - Landing Pages",
				formName: "MVC - Request Information | PPC | CSD | Test 2",
				formID: "DB59*1-JAG0OK",
				formLOC: formLOC,
				formSerial: formSerial,
				language: pageLang
			}
		} 

		digitalData.userInfo = {
			benefitLevel:"{capture OBL cookie (if present)}",
			ownerType:"{capture ownerType cookie (if present)}"
		}

		_satellite.track('form start');

		/* Show/Hide Comment Box */
		$("#showComment").click(function() {
			if ($("#comment").hasClass("hidden")) {
				$("#comment").show();
				$("#comment").toggleClass("hidden");
				$("#showComment i").toggleClass("icon-plus icon-minus");
			} else {
				$("#comment").hide();
				$("#comment").toggleClass("hidden");
				$("#showComment i").toggleClass("icon-plus icon-minus");
			}
		});
		
		/* Show/Hide Comment Box */
		$("#showComment").click(function() {
			if ($("#comment").hasClass("hidden")) {
				$("#comment").show();
				$("#comment").toggleClass("hidden");
				$("#showComment i").toggleClass("icon-plus icon-minus");
			} else {
				$("#comment").hide();
				$("#comment").toggleClass("hidden");
				$("#showComment i").toggleClass("icon-plus icon-minus");
			}
		});


		(function(){
			$('.hawaiian-airlines .ha-header-meta').appendTo('.navbar');

			/* Hide footer */
			setTimeout(function(){ $("footer .footer-container").remove(); }, 0);
		})();

		var haveFieldsError = function() {
			return $.makeArray($('.invalid-feedback')).some(function(element) {
				return $(element).is(':visible');
			});
		};

		var checkFieldsFirstStep = function() {
			var memberStatusError = $('#memberStatusError'),
				firstNameError = $('#firstNameError'),
				lastNameError = $('#lastNameError'),
				emailError = $('#emailError'),
				phoneError = $('#phoneError'),
				addressCountryCodeError = $('#addressCountryCodeError');

			if(!$('#memberStatus').val()) {
				memberStatusError.show();
			} else {
				memberStatusError.hide();
			}
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
			if(!$('#email').val()) {
				emailError.show();
			} else {
				emailError.hide();
			}
			if(!$('#phone').val()) {
				phoneError.show();
			} else {
				phoneError.hide();
			}
			if(!$('#addressCountryCode').val()) {
				addressCountryCodeError.show();
			} else {
				addressCountryCodeError.hide();
			}
		};

		var callSubmittedEntrySuccess = function() {
			window.location.replace("/landing/ppc/csd/v2thankyou/");
		}

		var onSubmit = function (event) {
			event.preventDefault();

			var email = $('#email').val(),
				emailValidationRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
				emailInfoError = $('#emailInfoError'),
				comment = $("#comment").val(),
				infoOptIn = $("#infoOptIn").is(":checked"),
				formId = 'DB59*1-JAG0OH',
				workQueueID = $('input[name=WorkQueueID]:checked').val();

			if(!email || !email.match(emailValidationRegex)) {
				emailInfoError.show();
			} else {
				emailInfoError.hide();
			}

			if(!haveFieldsError()) {
				// AJAXy stuff goes here?

				var formActionUrl = $(this).attr('action'),
					messageTypeID =$('input[name=MessageTypeID]:checked').val(),
					workQueueID = workQueueID,
					loc = formLOC;
					
					objToSend = $(this).serializeObject();
					objToSend.messageTypeID = messageTypeID;
					objToSend.workQueueID = workQueueID;
					objToSend.formId = formId;
				
				if (loc) {
					objToSend.originLOC = loc;
				}
				
				$.post(formActionUrl, objToSend);

				// Set session variables to populate digitalData
				sessionStorage.setItem("formOptIn", optIn);
				sessionStorage.setItem("formSerial", formSerial);

				if $('#memberStatus').val() == "Yes" {
					sessionStorage.setItem("requestInfoIsOwner", isOwner);
				}				

				window.location.replace("/landing/ppc/csd/v2thankyou/");
			}
		}

		$('.hero-element-info-body button').click( checkFieldsFirstStep );
		$('.hero-element-info-body button').submit( event, onSubmit )
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