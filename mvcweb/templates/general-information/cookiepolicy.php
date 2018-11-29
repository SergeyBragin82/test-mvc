<?php echo horizontalBreak(); ?>
<div style="display: none;" id='cookiesReferenceContent'>
<?php
	// Get shared cookie policy page, parsed as a string
	$dynamicContent = performGetRequest("https://www.marriottvacationsworldwide.com/common/cms/mvc/share/cookiepolicy.html", FALSE, FALSE);

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
			if(strpos($className, 'pageContentHeader') !== false) {
				// Concatenate and save for later
				$paragraphInfo .= DOMinnerHTML($divs);
			}
			if(strpos($className, 'pageContentBlock') !== false) {
				// Concatenate and save for later
				$paragraphInfo .= DOMinnerHTML($divs);
			}
			if(strpos($className, 'pageContentFooter') !== false) {
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

<div class="container general-info-cookies" id='cookiesContainer'>

	<div id='cookiesTable'></div>

	<div class="container general-info-cookies-bottom" id='cookiesBottom'></div>

</div>

<?php echo horizontalBreak(); ?>

<script>
	$(function() {
		<?php // Grab content as jQ object ?>
		var cookiesContentObject = $('#cookiesReferenceContent');

		<?php // Grab new container for content ?>
		var newContentObj = $('#cookiesContainer');

		<?php // Identify all headings in content ?>
		cookiesContentObject.find('h1,h2,h3,h4,h5,h6').addClass('general-info-title');

		<?php // Iterate thru all links, get rid of protocol ?>
		$.each(cookiesContentObject.find('a:contains("http:")'), function() {
			var html = $(this).html();
			$(this).html(html.replace(/(^https?:\/\/)|(\/)/g,''));
		});

		<?php // Grab cookie table from content ?>
		var cookiesTable = cookiesContentObject.find('.responsive-table');

		<?php // Iterate thru tags above cookie table, add them at the top of new container in reverse order ?>
		newContentObj.prepend($.makeArray(cookiesTable.prevUntil('div')).reverse());

		<?php // Add page title table at top of cooketable container ?>
		newContentObj.prepend(cookiesContentObject.find('.general-info-title')[0]);

		<?php // Iterate thru tags below cookie table, add them at the top of new container ?>
		$('#cookiesBottom').prepend(cookiesTable.nextAll('.shared'));

		<?php // Add cookie table at top of cooketable container ?>
		$('#cookiesTable').prepend(cookiesTable);

		<?php // Grab thru all links and remove target attribute ?>
		var allAboutCookies = newContentObj.find('> p ~ p > a');
		allAboutCookies.removeAttr('target');

		<?php // Make all links (except #cookiehome bookmark) fire external link modal ?>
		setupLegalPopup(allAboutCookies);
		$('#cookiesBottom').find('a').each(function(index) {
			if($(this).attr('href') !== '#cookiehome') {
				$(this).removeAttr('target');
				setupLegalPopup($(this));
			}
		});
	});
	setDataLayerGenericPage(
		generalInfoSiteSection,
		generalInfoSiteSection + ' | Cookie Policy',
	);
</script>
