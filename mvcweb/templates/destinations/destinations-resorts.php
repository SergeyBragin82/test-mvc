<?php
include(dirname(__DIR__) . "/partials/destinations.php");
$interests = $context->xpath('//Interest');
$resorts = $context->xpath('//Resort');
$heroContent = '<div class="container-fluid hero-element destination-resorts">
			<div class="row">
				<div class="col-xl-4">
					<div class="hero-element-info" id="vacation-style-info">
						<h1 class="hero-element-info-header">
							Vacation in Style
						</h1>
						<div class="break">
							<hr>
						</div>
						<div class="hero-element-info-body">
							<h3 class="title">spread out &amp; settle in</h3><p>Experience the difference a villa vacation can make at any of our more than 50 premium Marriott Vacation Club<sup>®</sup> resorts in the U.S. and around the world, including the Caribbean, Europe, Australia and Southeast Asia.</p><h3 class="title">be where the action is</h3><p>We also offer Marriott Vacation Club Pulse<sup>&#8480;</sup>  properties with distinctive guestrooms and suites in vibrant cities and prime locations throughout the U.S.</p>
						</div>
					</div>
				</div>
				<div class="col-xl-8 cover-picture-container">
					<img class="content" src="' . $GLOBALS['img_path'] . 'resorts%2Fcommon%2Fcms%2Fmvc%2Fimages%2Fresorts%2Fgalleries%2FGRANDEOCEAN%2F4x3Gallery%2F0-PRO-GR-P-101_Aerial_rgb.jpg" alt="View of Grand Residences by Marriott in South Lake Tahoe with a colorful sunset sky. " style="width: 120%;">
				
				</div>
			</div>
		</div>';
echo $heroContent;
$featuredResortOne;
$featuredResortOneDescription =  "Welcome to your paradise in paradise. Surrounded by brilliant white sand beaches, clear blue waters and lush island flora, Marriott’s Waikoloa Ocean Club invites you to relax, play and discover the splendor, history and culture of the Big Island.";
$featuredResortTwo;
$featuredResortTwoDescription = "Make your California dreams become vacation realities at <b>Marriott Vacation Club Pulse, San Diego</b>. With the Gaslamp Quarter, East Village and legendary San Diego Zoo all nearby, you’ll never run out of things to do and discover.";
foreach($resorts as $resort) {
	if ((string)$resort->xpath('@code')[0] === 'WK') {
		$featuredResortOne = $resort;
	}
	if ((string)$resort->xpath('@code')[0] === 'SD') {
		$featuredResortTwo = $resort;
	}
}

$trustResortElement = "<a class='resort-header-link' data-toggle='tooltip' data-placement='bottom' title='Marriot Vacation Club Top Resort' target='_blank' href='/state-and-legal-disclosures#legal6'>T</a>";
$exchangeResortElement = "<a class='resort-header-link' data-toggle='toooltip' data-placement='bottom' title='Marriot Vacation Club Exchange Resort' target='_blank' href='/state-and-legal-disclosures#legal6'>E</a>";

function getResortExchangeInfo($resort) {
	$toReturn = '';
	if ($resort->mvwcTrustResorts == 'true') {
		$toReturn .= "<a class='resort-header-link' data-toggle='tooltip' data-placement='bottom' title='Marriot Vacation Club Top Resort' target='_blank' href='/state-and-legal-disclosures#legal6'>T</a>";
	}
	if ($resort->mvwcExchangeResorts == 'true') {
		$toReturn .= "<a class='resort-header-link' data-toggle='toooltip' data-placement='bottom' title='Marriot Vacation Club Exchange Resort' target='_blank' href='/state-and-legal-disclosures#legal6'>E</a>";
	}
	return $toReturn;
}

$toDisplay = array();
$luxury = array();
$sortedDisplay = array();

foreach($context->xpath('//Region') as $region) {
	$xpath = "//Resort[@region='".$region->xpath('@value')[0]."']";
	$resort = $context->xpath($xpath)[0];
	if((string)$resort->code === 'RCC') {
		$luxury[] = $resort;
	} 
	$country = (string)$resort->country;
	$state = (string)$resort->state;
	$region = (string)$resort->region;
	$city = (string)$resort->city;

	if($country === 'USA') {
		if(!isset($toDisplay[$country])) {
			$toDisplay[$country] = array();
		}
		if(!emptyOrNull($state)) {
			if(!isset($toDisplay[$country][$state])) {
				$toDisplay[$country][$state] = array();
			}
			$toDisplay[$country][$state][] = $city;
		}
	} else {
		if(!isset($toDisplay[$region])) {
			$toDisplay[$region] = array();
		}
		if(!emptyOrNull($country)) {
			if(!isset($toDisplay[$region][$country])) {
				$toDisplay[$region][$country] = array();
			}
			if(!emptyOrNull($state)) {
				if(!isset($toDisplay[$region][$country][$state])) {
					$toDisplay[$region][$country][$state] = array();
				}
				if(!emptyOrNull($city)) {
						$toDisplay[$region][$country][$state][] = $city;
				}
			} else {
				if(!emptyOrNull($city)) {
						$toDisplay[$region][$country]['noState'][] = $city;
				}
			}
		}
	}
}

function sortAlphabetical($a, $b) {
	return strnatcmp($a, $b);
}

foreach($toDisplay as $region=>$country) {
	if ($region === 'USA') {
		uksort($toDisplay[$region], 'sortAlphabetical');
		foreach($toDisplay['USA'] as $state=>$city) {
			uasort($toDisplay['USA'][$state], 'sortAlphabetical');
		}
	} else {
		uksort($toDisplay[$region], 'sortAlphabetical');
		foreach($toDisplay[$region] as $country=>$state) {
			uksort($toDisplay[$region][$country], 'sortAlphabetical');
			foreach($toDisplay[$region][$country] as $state=>$city) {
				uasort($toDisplay[$region][$country][$state], 'sortAlphabetical');
			}
		}
	}
}

function featuredResort($resortInfo, $description, $alt) {
		$resortImg = getImageTag($resortInfo->image->image, $alt, array(0=>'img-fluid'));
		$resortLink = "<a class='marriott-btn' href='/vacation-resorts/" . $resortInfo->permalink ."'>explore</a>";
		$trustExchange = getResortExchangeInfo($resortInfo);
		$resortLocation = '';
		$resortTitle = checkForSpecialMarks(html_entity_decode(str_replace(array("<sup>", "</sup>"), "", $resortInfo->name)));
		if(!emptyOrNull($resortInfo->city)) {
			$resortLocation .= $resortInfo->city . ', ';
		}
		if(!emptyOrNull($resortInfo->state)) {
			$resortLocation .= $resortInfo->state . ', ';
		}
		if(!emptyOrNull($resortInfo->country)) {
			$resortLocation .= $resortInfo->country;
		}
		return <<<HTML
		<div class='image-description-parent'>
		<a href='$resortInfo->permalink'>
			
			<div class='image-container'>
				$resortImg
	</div>
	</a>
	
			<div class='destinations-resorts-item-content'>
				<div>
					<a href='$resortInfo->permalink'>
						<h4 class='title'>$resortTitle</h4>
					</a>
					$trustExchange
				</div>
				<h5 class='location-title'>
					$resortLocation
				</h5>
				<p class='description'>
					$description
				</p>
				$resortLink
			</div>
		</div>
HTML;
	}
 ?>

 	<style type="text/css">
 		
 		p.description {
    		z-index: 5000 !important;
    		position: relative;
		}

 	</style>

	<div class='destinations-resorts-item' style='display: none;' id='resortItemTemplate'>
		<div class='container'>
			<div class='row'>
				<div class="col-xl-6 image-col" id='resortImageContainer'>
					<a id='imageLink'>
						<div class='image-parent'>
						</div>
					</a>
				</div>
				<div class="col-xl-6 destinations-resort-item-column-content">
					<div class='destinations-resorts-item-content'>
						<div id='resortTitleContainer'>
							<a>
								<h4 class='title'></h4>
							</a>
						</div>
						<h5 class='location-title'>
						</h5>
						<p class='description'>
						</p>
						<div class='interests'>
						</div>
						<a class='marriott-btn' href=''>explore</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<ul id="resortCountries" style='display: none;'>
		<?php
		foreach($toDisplay as $region=>$country) {
			if($region === 'USA') { ?>
			<li data-value="country">
				USA
			</li>
			<?php
						foreach($toDisplay['USA'] as $state=>$cities) {
							if($state != 'noState') {
					?>
				<li data-value="state">
					<pre>&emsp;</pre>
					<?php echo($state); ?>
				</li>
				<?php
						}
							foreach($cities as $city) {
								$sortedDisplay = array_merge($sortedDisplay, $context->xpath("//Resort[@region='".$city . ', ' . $state ."']"));
					?>
					<li data-value="city">
						<pre>&emsp;</pre>
						<pre>&emsp;</pre>
						<?php echo($city); ?>
					</li>
					<?php
							}
						}
						?>
					<?php } else { ?>
					<li data-value="region">
						<?php echo($region); ?>
					</li>
					<?php
			foreach($country as $country=>$states) {
				?>
						<li data-value="country">
							<pre>&emsp;</pre>
							<?php echo($country); ?>
						</li>
						<?php
					foreach($states as $state=>$cities) {
						if($state !== 'noState') {
				?>
							<li data-value="state">
								<pre>&emsp;</pre>
								<pre>&emsp;</pre>
								<?php echo($state); ?>
							</li>
							<?php
						foreach($cities as $city) {
							$sortedDisplay = array_merge($sortedDisplay, $context->xpath("//Resort[@region='".$city . ', ' . $country ."']"));
					?>
								<li data-value="city">
									<pre>&emsp;</pre>
									<pre>&emsp;</pre>
									<pre>&emsp;</pre>
									<?php echo($city); ?>
								</li>
								<?php
						}
					} else {
						foreach($cities as $city) {
							$sortedDisplay = array_merge($sortedDisplay, $context->xpath("//Resort[@region='".$city . ', ' . $country ."']"));
					?>
									<li data-value="city">
										<pre>&emsp;</pre>
										<pre>&emsp;</pre>
										<?php echo($city); ?>
									</li>
									<?php
						}
					}
					}
			}
		}
	}
?>
		<li data-value='code'>
			Luxury
		</li>
	</ul>



	<div class='destinations-resorts'>
		<div class='destinations-container'>
			<h2 class='destinations-center-header'>
				Destination Spotlight
			</h2>
			<p>Explore the newest resort on the Big Island of Hawaii and the dazzling renovations at Marriott Vacation Club Pulse <sup>&#8480;</sup>, San Diego.</p>
			<div class='container-fluid destinations-resorts-premium-items image-description-container'>
				<div class='row'>
					<div class='col-lg-6'>
						<?php echo featuredResort($featuredResortOne, $featuredResortOneDescription, "An aeriel view of Marriott's Aruba Surf Club in Palm Beach, Florida overlooking the pool and ocean. "); ?>
					</div>
					<div class='col-lg-6'>
						<?php echo featuredResort($featuredResortTwo, $featuredResortTwoDescription, "The Marriott Vacation Club Pulse℠ in San Diego, California with the city lights at night. "); ?>
					</div>
				</div>
			</div>
		</div>

		<div class='destinations-container destinations-resorts-list'>
			<h2 class='title'>
				explore all resorts &amp; properties
			</h2>
			<div class='container destinations-resorts-dropdown-container'>
				<div class='row'>
					<div class='col-lg-6'>
						<div class='resort-search-container'>
							<input type='text' id='destinationResorts' class='resort-search' placeholder='Where do you want to go?'>
						</div>
					</div>
					<div class='col-lg-6'>
						<select class='resort-dropdown mb-2' id="destinationDropdownActivities" style="background-image: url(<?php echo $GLOBALS['img_path'] . 'dropdownArrowResort.png' ?>); ">
							<i class='icon-rounded-down'></i>
							<option value="" disabled selected>What would you like to do?</option>
							<option value='All'>
								Show all activities
							</option>
							<?php
			      		foreach($context->xpath("//Interest") as $interest) {
				      ?>
								<option value="<?php echo $interest->xpath('@code')[0];?>">
									<?php echo $interest->xpath('@text')[0];?>
								</option>
								<?php
			    	  	}
							?>
						</select>
					</div>
				</div>
			</div>

			<div id="resorts-container">
			</div>

			<div class="destinations-resorts-luxury-container" id="luxuryContainerTemplate" style="display: none;">
				<div class='destinations-resorts-luxury' id='luxuryList'>
				</div>
			</div>
			
			<script language="javascript">
				$(function () {
					var resorts = [];
					var Filter = {
						val: '',
						text: '',
					};
					var locationFilter = Object.create(Filter);
					locationFilter.val = 'All';
					var activityFilter = Object.create(Filter);
					activityFilter.val = 'All';
					<?php
					foreach($sortedDisplay as $resort) {
				?>
					var brandCode = "<?php echo $resort->code; ?>";
					resorts.push({
						imgUrl: '<?php echo $resort->image->image; ?>',
						imgAlt: "Image of <?php echo checkForSpecialMarks(html_entity_decode(str_replace(array(" < sup > ", " <
							/sup>"), "", $resort->name))); ?> in <?php echo $resort->city; ?>. ",
						isTrustResort: '<?php echo $resort->mvwcTrustResorts; ?>',
						isExchangeResort: '<?php echo $resort->mvwcExchangeResorts; ?>',
						name: "<?php echo checkForSpecialMarks(html_entity_decode(str_replace(array(" < sup > ", " <
							/sup>"), "", $resort->name))); ?>",
						city: "<?php echo $resort->city; ?>",
						state: "<?php echo $resort->state; ?>",
						permalink: "<?php echo $resort->permalink; ?>",
						region: "<?php echo $resort->region; ?>",
						country: "<?php echo $resort->country; ?>",
						description: "<?php echo escapeJavaScriptText($resort->description); ?>",
						interests: "<?php echo $resort->interests; ?>",
						disclaimer: "<?php echo escapeJavaScriptText($resort->disclaimer); ?>",
						code: brandCode === 'RCC' ? 'Luxury' : '',
					});
					<?php
					}
				 ?>

					function createResortElement(resortInfo) {
						var resortItem = $('#resortItemTemplate').clone(true);
						resortItem.show();
						var resortImageContainer = resortItem.find('#resortImageContainer');
						resortImageContainer.find('.image-parent').prepend($("<img class='img-fluid' alt=\"" + resortInfo.imgAlt + "\" src='" +
							resortInfo.imgUrl + "'>"));
						var resortTitleContainer = resortItem.find('#resortTitleContainer');
						resortItem.find('.row > a').attr('href', resortInfo.permalink);
						resortItem.find('#resortImageContainer').find('a').attr('href', resortInfo.permalink);
						resortTitleContainer.find('a').attr('href', resortInfo.permalink);
						var resortTitleElement = resortItem.find('.title');
						resortTitleElement.html(resortInfo.name);
						if (resortInfo.isTrustResort === 'true') {
							resortTitleContainer.append("<?php echo($trustResortElement); ?>");
						}
						if (resortInfo.isExchangeResort === 'true') {
							resortTitleContainer.append("<?php echo($exchangeResortElement); ?>");
						}
						var locationTitle = [resortInfo.city, resortInfo.state, resortInfo.country].filter(function (val) {
							return val.length > 0;
						}).join(', ');
						resortItem.find('.location-title').html(locationTitle);
						resortItem.find('.description').html(resortInfo.description);
						if (resortInfo.disclaimer) {
							console.log(resortInfo.disclaimer);
							resortItem.find('.description').append($('<p>').html(resortInfo.disclaimer).css({
								'margin-top': '0.5rem',
								'margin-bottom': '0'
							}));
						}
						// Interests
						var interestsContainer = resortItem.find('.interests');
						if (resortInfo.interests) {
							interestsContainer.prepend(resortInfo.interests.split(',').map(function (interest) {
								var cleaned = interest.toLowerCase().trim().replace('_', '');
								var validActivities = "golf,urban,ski,beach,themepark";
								if (validActivities.indexOf(cleaned) > -1)
									return $(
										"<div class='interests-container'><img src='<?php echo $GLOBALS['img_path']; ?>activities-icons/" +
										cleaned + ".svg'></div>");
							}));
						}
						resortItem.find('.marriott-btn').attr('href', '/vacation-resorts/' + resortInfo.permalink);
						return resortItem;
					}

					function generateResorts() {
						var noResultsObject = $(
							'<h3 class="text-center" style="margin-top: 1rem;">Sorry, we couldn\'t find anything that matched your search! <br>Please try again.</h3>'
						);
						var resortContainer = $('#resorts-container');
						var luxuryContainer = $('#luxuryContainerTemplate');
						var luxuryList = $('#luxuryList');
						luxuryList.empty();
						luxuryContainer.hide();
						resortContainer.empty();
						var filterFunc = function (resortToFilter) {
							return true;
						};
						if (locationFilter.val !== 'All' || activityFilter.val !== 'All') {
							filterFunc = function (resortToFilter) {
								var locationFilterVal = true,
									activityFilterVal = true;
								if (locationFilter.val !== 'All') {
									locationFilterVal = resortToFilter[locationFilter.val] === locationFilter.text;
								}
								if (activityFilter.val !== 'All') {
									activityFilterVal = resortToFilter.interests.indexOf(activityFilter.val);
								}
								return locationFilterVal && (activityFilterVal >= 0);
							}
						}
						var filteredResorts = resorts.filter(filterFunc);
						if (filteredResorts.length <= 0) {
							resortContainer.append(noResultsObject);
						} else {
							filteredResorts.forEach(function (resort) {
								if (resort.code === 'Luxury') {
									if (!luxuryContainer.is(':visible')) {
										luxuryContainer.show();
									}
									luxuryList.append(createResortElement(resort));
								} else {
									resortContainer.append(createResortElement(resort));
								}
							});
						}
					}
					// resort dataset
					function onActivityFilterChange(e) {
						activityFilter.val = $(this[this.selectedIndex]).val();
						activityFilter.text = $(this[this.selectedIndex]).text().trim();
						generateResorts();
					}

					generateResorts();
					var destinationsSource = $('#resortCountries').children().toArray();
					$('#destinationResorts').autocomplete({
						source: destinationsSource.map(function (element) {
							return {
								value: $(element).attr('data-value'),
								label: $(element).text(),
							}
						}),
						delay: 0,
						minLength: 0,
						select: function (e, ui) {
							e.preventDefault();
							var itemSelect = ui.item;
							if (itemSelect) {
								locationFilter.val = itemSelect.value;
								locationFilter.text = itemSelect.label.trim();
								if (itemSelect.value !== 'none') {
									$(this).val(itemSelect.label.trim());
								}
								generateResorts();
							}
							$(this).autocomplete('close');
						},
						close: function (e, ui) {
							var that = this;
							setTimeout(function () {
								that.blur();
							});
						},
						open: function (event, ui) {
							if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
								$('.ui-autocomplete').off('menufocus hover mouseover mouseenter');
							}
						},
						search: function (e, ui) {
							$(this).data('ui-autocomplete').menu.bindings = $();
						},
						response: function (e, ui) {
							if (ui && ui.content) {
								var contentLength = ui.content.length;
								if (contentLength === destinationsSource.length) {
									ui.content.unshift({
										value: 'All',
										label: 'All Resorts'
									});
								} else if (contentLength > 0) {
									ui.content.unshift({
										value: 'none',
										label: 'Search Results',
									});
								} else {
									ui.content.push({
										value: 'none',
										label: 'No Results Found',
									});
								}
							}
						},
					}).focus(function (e, ui) {
						$(this).val('');
						$(this).autocomplete('search', '');
					});
					var autoComplete = $('#destinationResorts').autocomplete('instance');
					console.log(autoComplete);
					autoComplete._renderItem = function (ul, item) {
						if (item.value === 'none') {
							return $('<li>').attr('class', 'ui-state-disabled').append(item.label).css('opacity', '1.0').appendTo(ul);
						} else {
							return $("<li>")
								.attr("data-value", item.value)
								.append("<a>" + item.label + "</a>")
								.appendTo(ul);
						}
					};
					$("#destinationDropdownActivities").change(onActivityFilterChange);
				});

				setDataLayerGenericPage(
					resortSiteSection,
					'MVC - Explore Our Resorts'
				);
			</script>
		</div>
	</div>
