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
			<div class="col-xl-4" style="position: relative;">
				<div class="hero-element-info">
					<div class="ha-step ha-step--1" id="haStep1">
						<h1 class="hero-element-info-header">
							Thank You!
						</h1>

						<div class="hero-element-info-body">
							<h6 style="color: #009687; padding: 10px 0; font-weight: bold; letter-spacing: 3px;">YOUR REQUEST HAS BEEN RECEIVED</h6>
							<h6>What can you expect next? A knowledgeable Sales Executive will contact you soon to provide an inspiring and informative overview of our program. Your personalized experience will include a discussion of the vacations and resorts you are most interested in, and how you can save on future vacations through the Marriott Vacation Club Destinations&trade; Program.</h6>
							<h6>Again, thank you for your interest. We look forward to speaking with you.</h6>
						</div><!-- / .hero-element-info-body -->
					</div><!-- / .ha-step--1 -->
				</div><!-- / .hero-element-info -->
				<div style="position: absolute; bottom: 0; right: 0; padding: 10px 25px;">MDC-18-294</div>
			</div>
		</div><!--  / .row -->
	</div><!--  / .hero-element -->
	<script>
		/* Dynamic phone number */
		var urlParams = new URLSearchParams(window.location.search);
		var formLOC = urlParams.get('LOC');

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
		var optIn = sessionStorage.getItem("formOptIn");
		var isOwner = sessionStorage.getItem("requestInfoIsOwner")
		var formSerial = sessionStorage.getItem("formSerial")

		digitalData = {
			pageInfo: {
				pageName: "MVC - Landing Pages | PPC | CSD | Test 2 | Thank You",
				siteSection: "MVC - Landing Pages",
				formName: "MVC - Request Information | PPC | CSD | Test 2",
				formID: "DB59*1-JAG0OK",
				formLOC: formLOC,
				formOptIn: optIn,
				formSerial: formSerial,
				requestInfoIsOwner: isOwner,
				language: pageLang
			}
		} 

		digitalData.userInfo = {
			benefitLevel:"{capture OBL cookie (if present)}",
			ownerType:"{capture ownerType cookie (if present)}"
		}

		_satellite.track('form complete');

		(function(){
			$('.hawaiian-airlines .ha-header-meta').appendTo('.navbar');

			/* Hide footer */
			setTimeout(function(){ $("footer .footer-container").remove(); }, 0);
		})();

		
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
