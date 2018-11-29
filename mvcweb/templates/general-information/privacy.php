<?php
	$privacyPdfLocation = $GLOBALS['asset_path'] . 'mvcweb/files/Internet-Privacy-Policy.pdf';
	$fraudelentInfoPdfLocation = $GLOBALS['asset_path'] . 'mvcweb/files/Additional_Information_on_Fraudulent_Emails.pdf';
?>
<div class='dynamic-content' style="display: none;">
<?php
	// Get shared cookie policy page, parsed as a string
	$dynamicContent =  performGetRequest("http://www.marriottvacationsworldwide.com/privacy.shtml", FALSE, FALSE);

	// Create new DOM object
	$contentDOM = new DOMDocument();

	// Get rid of redundant whitespace
	$contentDOM->preserveWhiteSpace = false;

	// Nicely formats output with indentation and extra space
	$contentDOM->formatOutput = true;

	// Load new DOM object w/ content from shared cookie policy page
	@$contentDOM->loadHTML($dynamicContent);

	// Iterate thru div tags
	$paragraphInfo = '';
	foreach($contentDOM->getElementsByTagName('div') as $divs) {
		if($divs->hasAttribute('class')) {

			// If div has the string "content" in its class attribute
			$className = $divs->getAttribute('class');
			if(strpos($className, 'content') !== false) {
				if ($divs->hasAttribute('style') && strpos($divs->getAttribute('style'), 'display') !== false) {
					continue;
				}
				// Concatenate and save for later
				$paragraphInfo .= DOMinnerHTML($divs);
			}
		}
	}

	// Later:
	// Echo out content into this hidden container to be accessed by JS below
	echo $paragraphInfo;
?>
</div>
<div class="container general-info-privacy">
	<h1 class='general-info-title' id='privacyTitle'>
	</h1>
	<div class="container-fluid general-info-privacy-accordion">
		<div class="row">
			<div class="col">
				<div class='accordion' id='privacyAccordion' style="padding-bottom: 40px">
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo horizontalBreak(); ?>

<script>
	$(function() {
		<?php // Grab content as jQ object ?>
		var privacyContentObject = $('.dynamic-content').clone();

		<?php // Update link to cookie-policy page ?>
		privacyContentObject.find('.cookietablepagelink').attr('href', '/cookie-policy');

		<?php // Update link to Privacy PDF and add to top of main content ?>
		$('.dynamic-content > a').attr('href', <?php echo json_encode($privacyPdfLocation); ?>).prependTo( $('.general-info-privacy') );

		<?php // Grab page title and append main content ?>
		$('#privacyTitle').html( privacyContentObject.find('h1').html() ).after( privacyContentObject.find('.pageContentBlock').html() );

		<?php // Replicate accordion functionality ?>
		$('#privacyAccordion').append(privacyContentObject.find('.panel-group').removeAttr('id'));
		$( ".panel-heading" ).accordion()
		$(document).on('click', '.panel-heading', function(){
			$(this).next().stop(true, true).slideToggle();
		});

		<?php // ??? ?>
		$('#ui-id-4').find('a').attr('href', <?php echo json_encode($fraudelentInfoPdfLocation);?>);
		
		<?php // Bind external link modal to specific links ?>
		var australiaInfoLink = $('#privacyAccordion').find('h3:contains("Region-Specific")').next().find('a:contains("Australian Information")');
		australiaInfoLink.attr({
			onclick: 'javascript:attachLegalPopupToExternalLinks("' + australiaInfoLink.attr('href') + '")',
			href: 'javascript: void(0);'
		}).removeAttr('target');

		var australiaOAICLink = $('#privacyAccordion').find('a[href*="oaic.gov"]');
		australiaOAICLink.attr({
			onclick: 'javascript:attachLegalPopupToExternalLinks("' + australiaOAICLink.attr('href') + '")',
			href: 'javascript: void(0);'
		}).removeAttr('target');

		<?php // Open and scroll to specific accordion blocks, based on query string ?>
		if (window.location.href.indexOf("#Cookies") > -1) {
		    setTimeout(function(){
		        $('#privacyAccordion').find(".cookies .panel-heading").trigger("click")
		    }, 2000);

		    $('html, body').animate({
		        scrollTop: $('div.general-info-privacy').find("div.panel-group.cookies").offset().top
		    }, 2000);
		}
		if (window.location.href.indexOf("#info") > -1) {
		    setTimeout(function(){
		        $('#privacyAccordion').find(".information .panel-heading").trigger("click")
		    }, 2000);

		    $('html, body').animate({
		        scrollTop: $('div.general-info-privacy').find("div.panel-group.information").offset().top
		    }, 2000);
		}
		$('div.general-info-privacy div#accordion.panel-group').remove();

		for (i = 1; i < $('div.panel-group.cookies:not("#accordion") a').length; i++) {
			var cookieLink = $('div.panel-group.cookies:not("#accordion") a:eq(' + i + ')');
			var cookieHref = $('div.panel-group.cookies:not("#accordion") a:eq(' + i + ')').attr('href');
			var cookieText = $('div.panel-group.cookies:not("#accordion") a:eq(' + i + ')').text();

			cookieLink.replaceWith("<a href='javascript: void(0);' onclick='javascript:attachLegalPopupToExternalLinks(&quot;" + cookieHref + "&quot;)'>" + cookieText + "</a>");
		}
	});
</script>