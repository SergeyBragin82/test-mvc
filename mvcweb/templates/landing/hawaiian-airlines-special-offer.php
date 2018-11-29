<?php
	// Hawaiian Airlines
?>
<div class="hawaiian-airlines hawaiian-airlines--special">
	<link rel='stylesheet' id='ha-css'  href='/wp-content/plugins/mvcweb/assets/mvcweb/css/ha.css?v=1' type='text/css' media='all' />
	<div class="ha-header-meta">
		Call <a href="tel:855-385-2312">855-385-2312</a>
		<a href="https://home-c20.incontact.com/incontact/chatclient/chatclient.aspx?poc=52dff431-cf38-461d-bf8c-59d9fafacfea&bu=4595893" title="Chat Now" class="marriott-btn" target="_blank">Chat Now</a>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-6">
				<h1>Special Offer</h1>
				<p>We're delighted that you qualify to receive the following special offer: on your next stay at a Marriott Vacation Club<sup>&reg;</sup> resort when you book through Marriott.com.<br /> Special Offer: Save 10% on 3 or more consecutive nights at a Marroitt Vacation Club<sup>&reg;</sup> resort of your choice.*</p>

				<p><a href="https://www.marriottvacationsworldwide.com/common/cms/mvc/pdfs/1784739_48_ICT_WebCoupons10_WB.pdf" title="Marriott Vacation Club - Save 10%" target="_blank">Get certificate for complete details and instructions.</a></p>
			</div>
			
			<div class="col-xl-6">
				<h2>Thank you</h2>
				<p>You earned <strong>100 HawaiianMiles</strong> just for inquiring about your special offer!</p>
			</div>
		</div><!--  / .row -->

		<footer class="row">
			<div class="disclaimer">
				<p>DISCLAIMER: *Valid only for discounted reservations completed and confirmed prior to check-in.</p>

				<p>Promotional rate requires a 3-night minimum stay and must be available at time of booking. Advance booking with a credit card is required for discount to be valid. Certificate expires one year from date of issuance and is required. Maximum of two villas allowed per certificate. Discount is off regular rates and cannot be combined with any other discount. Discount is based on availability and certain blackout dates may apply.</p>

				<p>HawaiianMiles will be deposited into your account by Hawaiian Airlines. For more information about HawaiianMiles please visit <a href="javascript: void(0);" onclick='javascript:attachLegalPopupToExternalLinks("https://www.hawaiianairlines.com/")' title="Hawaiian Airlines" target="blank"></a>www.hawaiianairlines.com.</p>
			</div>
		</footer><!--  / .row -->
	</div><!--  / .hero-element -->
	<script>
		$('.hawaiian-airlines .ha-header-meta').appendTo('.navbar')
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
