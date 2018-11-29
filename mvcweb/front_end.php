<?php

	include('templates/partials/snippets.php');
	global $post;

	$skip_theme = FALSE;
	$context = NULL;
	$path = $_SERVER['REQUEST_URI'];
	$currUrl = get_site_url() . $path;
	$query = parse_url($currUrl, PHP_URL_QUERY);
	parse_str($query, $queryArr);
	$noCaseQuery = array_change_key_case($queryArr);
	$defaultPhoneNumber = "1-800-307-7312";
	$defaultPhoneNumberDisplayString = "800-307-7312";
	
	// Retrieve analytics data required for all pages using slug as index
	$digitalLayerData = json_decode(file_get_contents(dirname(__FILE__) . "/data/digitalLayerData.json"));
	$digitalLayerObj = NULL;
	if (is_404()) {
		$digitalLayerObj = array(
			'pageInfo' => array(
				'pageName' => '404:',
				'errorCode' => '404'
			)
		);
	} else if ($post) {
		$context = simplexml_load_string(get_post_field( 'post_content', $post->ID));
		$post_slug = strtolower(str_replace('-shtml', '', $post->post_name));
		$split = array();
		if(strpos($post_slug, '-')) {
			$split = array_filter(explode('-', $post_slug), function($value) { return $value !== ''; });
		}
		if (isset($_COOKIE['loc']) || array_key_exists('loc', $noCaseQuery)) {
			// Let's try to find override of phone number
			$locDataXml = new SimpleXMLElement(get_option("MVC_LOC_DATA"));
			if(array_key_exists('loc', $noCaseQuery))
				$locInfo = $noCaseQuery['loc'];
			else if (isset($_COOKIE['loc']))
				$locInfo = $_COOKIE['loc'];
			if (!emptyOrNull($locInfo)) {
				$locNode = $locDataXml->xpath('//loc_data/Row[@LOC="' . $locInfo . '"]');
				if(count($locNode) > 0) {
					$locData = $locNode[0];
					if(!emptyOrNull($locData)) {
						$defaultPhoneNumberDisplayString = (string)$locData->Phone;
						$defaultPhoneNumber = "1-" . $defaultPhoneNumberDisplayString;
					}
				}
			}
		}

		$isEbrochure = ( strpos($currUrl, 'ebrochures') && strpos($currUrl, 'ebrochures/mvc-resorts-and-properties') === FALSE ) !== FALSE;

		if ( $isEbrochure ) {
			$resort_pages = ['overview', 'features', 'amenities', 'activities'];
		} else {
			$resort_pages = ['accommodations', 'amenities', 'map', 'activities'];
		}
		
		if($context && ((count($split) > 0 && count($context->xpath('Resort/marshaHotelCode')) > 0 && $split[0] === strtolower((string)($context->xpath('Resort/marshaHotelCode')[0]))) || in_array($post_slug, $resort_pages) || $isEbrochure)) {
			// we have a resort page
			$resortNameData = (string)($context->xpath('Resort/altName')[0]);
			$pageSection = $isEbrochure ? 'MVC - Ebrochures' : 'MVC - Resorts';
			$resortPageType = in_array($post_slug, $resort_pages) ? ucfirst($post_slug) : 'Overview';
			$digitalLayerObj = array(
				'pageInfo' => array(
					'pageName' => $pageSection . ' | ' . $resortNameData . ' | ' . $resortPageType,
					'siteSection' => $pageSection,
					'resortName' => $resortNameData,
					'resortID' => (string)$context->xpath('Resort/code')[0],
					'resortCity' => (string)$context->xpath('//city')[0],
					'resortState' => (string)$context->xpath('//state')[0],
					'resortCountry' => (string)$context->xpath('//country')[0],
					'resortMARSHA' => (string)$context->xpath('Resort/marshaHotelCode')[0],
					'resortPageType' => $resortPageType,
					'resortBrand' =>  (string)$context->xpath('Resort/Brands/code')[0],
				),
			);
		} else if(isset($digitalLayerData->$post_slug)) {
		// If a slug is found, then read the info for that page
			$digitalLayerObj = array();
			foreach($digitalLayerData->$post_slug as $key=>$value) {
				
				if($post_slug === 'ilg-acquisition') {
					$slug = $post->post_title;
					
					$digitalLayerObj = array(
						'pageInfo' => array(
							'siteSection' => 'MVC - General Information',
							'pageName' => 'MVC - General Information | '. $slug . '',
						
						),
					);
				} else {
					$digitalLayerObj[$key] = $value;
				}
			}
		} else {
			$searchTerm = get_query_var('keyword');
			$count = NULL;
			if ($searchTerm !== NULL) {
				if (isset($_GET['pagination'])) {
					$page = (int)$_GET['pagination'];
				} else {
					$page = 1;
				}
				// we have a search
				$searchObj = new WP_Query( 
					array(
					'post_type' => 'page',
					's' => get_query_var('keyword',''),
					'posts_per_page' => 10,
					'paged' => $page
					)
				);
				$count = (string)$searchObj->found_posts;
				if (empty($count) || $count === '0') {
					$count = 'zero';
				}
			}
			if($post_slug === 'search') {
				$digitalLayerObj = array(
					'pageInfo' => array(
						'siteSection' => 'MVC - General Information',
						'pageName' => 'MVC - General Information | Search Results',
						
					),
					'search' => array(
						'term' => $searchTerm !== NULL ? $searchTerm : '',
						'results' => $count !== NULL ? $count : 'zero',
					)
				);
			}
		}
	}

	if (get_query_var('keyword')!=NULL) {
		$template = "templates/search.php";
	} else {

		if(!$context) {
			// page not found, 404
			$context = new SimpleXmlElement("<mvcweb/>");
			$template = $context->addChild("template");
			$template->addAttribute("name", "404");
			$template->addAttribute("skip_theme", "false");
			$template->addAttribute("skip_nav", "false");
			add_filter('wp_headers', 'notfound_header');

		}
		
		$template = "templates/{$context->xpath("/mvcweb/template/@name")[0]}.php";
		$skip_theme = (string)$context->xpath("/mvcweb/template/@skip_theme")[0] === "true";
	}

	function notfound_header() {
		$headers["status"] = "404";
	}

	function search_filter($query)
    {

    	$exclude = explode(",", get_option("MVC_SEARCH_EXCLUDE"));
        $query->set('post__not_in', $exclude);
        return $query;
    }

	add_filter('pre_get_posts', 'search_filter');
?>
<?php if ($skip_theme === FALSE) {?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,shrink-to-fit=no"
		/>
		<?php echo setMetas($path, $context); ?>
		<style id="antiClickjack">body{display:none !important;}</style>
		<?php wp_head() ?>
		<script type="text/javascript">
			if (self === top) {
				var antiClickjack = document.getElementById("antiClickjack");
				antiClickjack.parentNode.removeChild(antiClickjack);
			} else {
				top.location = self.location;
			}
			var digitalData = <?php echo json_encode($digitalLayerObj, JSON_PRETTY_PRINT); ?> || {};
			if (digitalData.pageInfo && digitalData.pageInfo.errorCode && digitalData.pageInfo.errorCode === '404') {
				digitalData.pageInfo.pageName += window.location.href;
			}

			var benefitLevelCookie = Cookies.get('ownerBenefitLevel');
			ownerTypeCookie = Cookies.get('ownershipType');
			digitalData.userInfo = {
				benefitLevel: benefitLevelCookie || "No OBL",
				ownerType: ownerTypeCookie || "Non-Owner"
			};
			if (digitalData.pageInfo && digitalData.pageInfo.formLOC){
				var newLoc = getUrlParam('loc') || Cookies.get('loc');
				digitalData.pageInfo.formLOC = newLoc || digitalData.pageInfo.formLOC;
			}
			var corpCode = getUrlParam('corporateCode');
			if (corpCode) {
				sessionStorage.setItem('corporateCode', corpCode.trim());
			}
		</script>
		<?php
			$siteUrl = get_site_url();

			$scripts = [
                'tpd1'    => '<script src="//assets.adobedtm.com/launch-EN2cfbf54f3d8a4243b590278c8c6aa32e-development.min.js" async></script>',
                'tpd2'    => '<script src="//assets.adobedtm.com/launch-EN8c3efd88fdd34005a033b61186b8ea68-development.min.js" async></script>',
                'tpd3'    => '<script src="//assets.adobedtm.com/launch-ENd38dac75aa14466da66a9bbf493b2b30-development.min.js" async></script>',
                'tpd4'    => '<script src="//assets.adobedtm.com/launch-ENeed993cb01724d478b7e027697974699-development.min.js" async></script>',
                'tpd5'    => '<script src="//assets.adobedtm.com/launch-EN443eb51a6c1444d0952ea6fbc3deb478-development.min.js" async></script>',
                'tps1'    => '<script src="//assets.adobedtm.com/launch-EN6f46b9a9181745c9b45662985c793fec-staging.min.js" async></script>',
                'prod'    => '<script src="//assets.adobedtm.com/launch-EN31aa2451be744634a8b3889f449cad55.min.js" async></script>',
                'default' => '<script src="//assets.adobedtm.com/launch-EN2cfbf54f3d8a4243b590278c8c6aa32e-development.min.js" async></script>'
            ];

			foreach ($scripts as $hostName => $script) {
			    if ($hostName == 'default' || strpos($siteUrl, $hostName) !== FALSE) {
                    echo $script;
                    break;
                }
			}
		?>

				<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
	</head>

	<body>
		<a href="#mobileMenuPanel" class="skip">Skip to content</a>
		<?php include('templates/header.php'); ?>
		<header class='header-mobile fixed-header'>
			<div class='resort-submenu' id='submenu-mobile'></div>
				<a href='/'>
					<div class='logo-mobile'>
						<?php echo getImageTag('mobile-logo.svg', 'Marriott Vacation Club Logo', NULL, true); ?>
					</div>
				</a>
				<?php // If page is a /landing page, do not display mobile menu button ?>
				<?php if( false === strpos($_SERVER['REQUEST_URI'], '/landing') ) { ?>
					<button class="hamburger hamburger--collapse header-toggle-button" type="button" aria-controls="mobileMenu" aria-expanded="false"
				  aria-label="Toggle menu navigation">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				<?php } // if( false !== strpos($_SERVER['REQUEST_URI'], '/landing') ) ?>
			</header>
			<div class='resort-submenu' id='submenu-desktop'></div>
		<main id="mobileMenuPanel" class="panel">
			<?php include($template); ?>

			<footer>
				<?php include('templates/footer.php'); ?>
				<?php include('templates/legal-footer.php'); ?>
			</footer>
		</main>
		<!-- Modal Sweepstakes -->
		<div class="modal fade marriott-modal" id="sweepstakesModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<p>By choosing to enter the Where Will You Go Sweepstakes, you acknowledge that you are being redirected to a website
							operated by Don Jagoda Associates, Inc., a third party that has been engaged to administer and conduct the sweepstakes
							on behalf of Marriott Ownership Resorts, Inc. Please
							<a class='general-info-link' href='https://dja.com/privacy-policy' target='_blank'>click here</a> to read the Don Jagoda Associates internet privacy statement.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class='marriott-btn' id='sweepstakesModalConfirm'>yes</button>
						<button type="button" class="marriott-btn" id='sweepstakesModalClose'>no</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal External Link Confirm -->
		<div class="modal fade marriott-modal" id="legalExternalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<p>By clicking "Yes" below, you acknowledge being transferred to a website that is not owned, operated or controlled by
							Marriott Vacation Club (MVC), and that MVC is not responsible for information or activities associated with such website.
							Further, you acknowledge that MVC shall not be liable to you or any third party for any claims, damages, or losses
							of any kind that may result from your use of such website.
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class='marriott-btn' id='modalLegalConfirm'>yes</button>
						<button type="button" class="marriott-btn" id='modalLegalClose'>no</button>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function toggleMenuSearch(obj, e) {
				var container = $(obj).closest('.search-menu-container');
				if (!container.hasClass('active')) {
					container.addClass('active');
					container.find('.search-menu-input').focus();
					e.preventDefault();
				} else {
					if (
						(e.target.id === 'search_input_box' && e.type === 'blur') ||
						(e.target.className === 'search-icon' && e.type === 'click')) {
						container.removeClass('active');
					}
					// clear input
					container.find('.search-menu-input').val('');
				}
			}

			$(function () {
				function checkHamburgerActive() {
					$('.header-toggle-button').toggleClass('is-active');
				}

				var slideoutWidth;
				var slideout = null;

				$("#search_input_box_go").on("click", function (e) {
					doSearch($('#search_input_box').val());
				});
				$("#search_input_box_mobile").keyup(handleSearchRequest);
				$('#search_input_box').on({
					blur: function (e) {
						toggleMenuSearch(this, e);
					},
					keyup: handleSearchRequest,
					keydown: function (e) {
						if (e.key === 13) {
							doSearch($(this).val());
						}
					}
				});


				$('.mobile-menu-dropdown-li').click(function () {
					$(this).find('.mobile-menu-options').toggleClass('mobile-menu-options-active');
				});

				// Slideout setup
				function updateSlideoutObject() {
					screenWidth = getScreenSize().x;
					slideoutWidth = screenWidth * 0.80;

					if (slideout) {
						if (screenWidth > 1130) {
							if (slideout.isOpen()) {
								$('#mobileMenuPanel').attr('style', 'transform: translateX(0);');
								slideout.close();
							}
						} else {
							slideout['_padding'] = slideoutWidth;
							slideout['_translateTo'] = -slideoutWidth;
							slideout['_currentOffsetX'] = -slideoutWidth;
							if (slideout['_opened']) {
								$('#mobileMenuPanel').css('transform', 'translateX(' + -slideoutWidth + 'px)');
							}
						}
					} else if (screenWidth <= 1130) {
						slideout = new Slideout({
							'panel': document.getElementById('mobileMenuPanel'),
							'menu': document.getElementById('mobileMenu'),
							'padding': slideoutWidth,
							'side': 'right',
							'touch': false,
						});
						var fixedHeader = $('.fixed-header');

						slideout.on('translate', function(translated) {
							fixedHeader.css({
								transform: 'translateX(' + translated + 'px)',
							});
						});
						slideout.on('beforeopen', function() {
							fixedHeader.css({
								transition: 'transform 300ms ease',
								transform: 'translateX(-' + slideoutWidth + 'px)',
							});
						});
						slideout.on('beforeclose', function() {
							fixedHeader.css({
								transition: 'transform 300ms ease',
								transform: 'translateX(0px)',
							});
						});
						slideout.on('open', function (e) {
							checkHamburgerActive();
							fixedHeader.css({
								transition: '',
							});
						});
						slideout.on('close', function (e) {
							checkHamburgerActive();
							fixedHeader.css({
								transition: '',
							});
						});
						$('.header-toggle-button').on('click', function () {
							slideout.toggle();
						});
					}
				}

				onWindowResize(updateSlideoutObject, 100);

				updateSlideoutObject();

				setupReadMore();
				//Modal dialogs behavior setup
				$('#sweepstakesModalClose').click(function () {
					$('#sweepstakesModal').modal('hide');
				});
				$('#sweepstakesModalConfirm').click(function () {
					openLinkNewTab($(this).attr('data-link'));
					$('#sweepstakesModal').modal('hide');
				});
				$('#modalLegalClose').click(function () {
					$('#legalExternalModal').modal('hide');
				});
				$('#modalLegalConfirm').click(function () {
					openLinkNewTab($(this).attr('data-link'));
					$('#legalExternalModal').modal('hide');
				});
				// Enable PCM modal hyperlinks to launch external link modal (ALM 38726)
				$(document).on("click", ".confirmation_", function(){
					var link = $(this).attr('destination');
					$("#legalExternalModal").modal();
					$("#modalLegalConfirm").attr("data-link", link);
				});


				function handleDataLayerNavClick() {
					var typeToSend = '';
					var desktop = $(this).closest('.header-option');
					if (desktop.length > 0) {
						typeToSend = decodeEntities(desktop.find('span').html().trim());
					}
					var mobile = $(this).closest('.mobile-menu-dropdown-li').find('.mobile-menu-dropdown-li-header');
					if (mobile.length > 0) {
						typeToSend = decodeEntities(mobile.find('span').html().trim());
					}
					digitalData.tab = {
						name: decodeEntities($(this).html().trim()),
						type: typeToSend,
					};
					satelliteTrack('tab click');
				}

				function handleNoDropdownDataLayerClick(obj) {
					var $obj = obj || $(this);
					var html = decodeEntities($obj.html().trim());
					digitalData.tab = {
						name: html,
						type: html
					};
					satelliteTrack('tab click');
				}

				$('.header-navbar-dropdown-option').click(handleDataLayerNavClick);
				$('.mobile-menu-dropdown-option').click(handleDataLayerNavClick);
				$('.header-option').click(function() {
					if($(this).hasClass('header-navbar-dropdown') || 
						$(this).hasClass('search-menu-container')) {
						return;
					}
					var text = decodeEntities($(this).html().trim());
					setDataLayerNavClick(text, text);
				});
				$('.mobile-menu-dropdown-li-header').click(function() {
					if ($(this).next().find('.mobile-menu-dropdown-option').length > 0) {
						return;
					}
					var text = decodeEntities($(this).html().trim());
					setDataLayerNavClick(text, text);
				})
				$('#requestInfoBtnDesktop').click(
					function() {
						clearPromoFormStore();
						handleNoDropdownDataLayerClick($(this));
					});
				$('#requestInfoDesktopFooter').click(function(){
					clearPromoFormStore();
					handleNoDropdownDataLayerClick($(this));
				})
				$('#requestInfoMobile').click(function() {
					var text = decodeEntities($(this).find('.mobile-menu-button').html().trim());
					setDataLayerNavClick(text, text);
					clearPromoFormStore();
				});

			});
			$('#promotionHeaderInfo').click(setPromoFormStoreClicked)
			watchForHover();

			if (typeof (_satellite) !== 'undefined') {
				_satellite.pageBottom();
			}
			// Check what we have in the analytics data layer
		</script>
	</body>

	</html>
	<?php } else {
	include($template);
}
?>