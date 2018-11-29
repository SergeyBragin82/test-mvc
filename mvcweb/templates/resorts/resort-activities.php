<?php
	$pageType = "Activities";
	$resort = $context->Resort[0];
	$localActivitiesData = $resort->LocalActivitiesCollection->LocalActivities[0];
  $bookingHeader = $localActivitiesData->localActivitiesTitle;
	$bookingParagraph = $localActivitiesData->localActivitiesIntro;
	$carouselImages = array();
	$images = $context->xpath('Resort/resort_imagery/image[section="Activities"]');


	if (count($images) ===0 ) {
		$images = $context->xpath('Resort/resort_imagery/image');		
	}

	foreach($images as $image) {
		$carouselImages[] = (object)(array(
			'imgPath' => $image->image,
			'imgAltTag' => $bookingHeader . " " . $image->caption . ". Things to do in " . $context->xpath("Resort/ResortAddress/city")[0] . ".",
			'imgCaption' => $image->caption
		));
	}
	include(dirname(__DIR__) . '/partials/resort.php');
?>
<?php 
	$excluded_resorts = explode(",", get_option("MVC_CONFIG_EXCLUDED_ACTIVITIES_RESORTS"));
	if(!in_array($context->xpath("Resort/code")[0], $excluded_resorts)) {
?>
	<div class='activities-container'>
		<h2 class='activities-title mt-4'>
			Activities
			<div class='activities-title-underline'></div>
		</h2>
		<p style='white-space: normal;'>
			To help you plan your ideal vacation, we've curated the most popular activities that can be found both at our resort and
			in the&nbsp;surrounding&nbsp;area.
			<br>
			<br>Simply select "Off&ndash;Site" or "On&ndash;Site" and the category of activities that you're interested in and we'll do
			the legwork&nbsp;for&nbsp;you!
			<br>
			<br> All onsite activities are complimentary unless noted by a $ or €.
		</p>
	</div>
	<div class="activities-menu-wrapper">
		<div class='activities-menu-container'>
		</div>
	</div>
	<div class='container-fluid activities mt-2'>

		<div class='row activities-interface mx-0'>
			<div class='col-md-5 px-0'>
				<div class='activities-filter-menu'>
					<a class='activities-filter-button' href='javascript:void(0);' id='onSiteActivities'>
						on&ndash;site
					</a>
					<a class='activities-filter-button' href='javascript:void(0);' id='offSiteActivities'>
						off&ndash;site
					</a>
				</div>
				<div class='activities-list-container activities-list-container-onsite' style="display:none;">
					<?php 
					foreach($context->xpath("//OSARowCollection/Row") as $activity_row) {
				?>
					<div>
						<div class='activities-list-item'>
							<div class='container'>
								<div class='row'>
									<div class='col-lg-3 activities-list-item-picture text-center'>
										<img class="ml-3" src='/wp-content/plugins/mvcweb/assets/images/NO_IMG.png' alt='No Image' />
									</div>
									<div class='col-lg-9 activities-list-item-content'>
										<h3 class='activities-list-item-header activities-list-item-header-onsite'>
											<?php if ($activity_row->xpath("ActivityTitle")[0]!="") {
													$currencyText = $activity_row->xpath("currency")[0];
													echo $activity_row->xpath("ActivityTitle")[0];
												} else {
													echo "No Available Activity Title.";
												}?>
										</h3>
										<div class='activities-list-item-extra'>
											<?php if ($activity_row->xpath("ActivityDescription")[0]=="" && $activity_row->xpath("ActivityDetails")[0]=="") {?> No available description.
											<?php }  else { ?>
											<?php echo $activity_row->xpath("ActivityDescription")[0] ?>
											<br/>
											<?php echo $activity_row->xpath("ActivityDetails")[0] ?>
											<?php if ($currencyText!="") {
														echo "<br/>" . $currencyText;
													}
												} ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='break'>
							<hr />
						</div>
					</div>
					<?php
					}
				?>
				</div>
				<div class='activities-list-container activities-list-container-offsite'>
				</div>
			</div>
			<div class='col-md-7 activities-map-container activities-map-container-offsite'>
			</div>
			<div class='col-md-7 activities-map-container activities-map-container-onsite mt-0 d-flex align-items-center'>
				<?php 
				$resort_map = $context->xpath("Resort/ResortMapCollection/ResortMap/Media/realFileName")[0];
				$resort_map_filename = "";
				$resort_map_alttext = "";
				$resort_map_local = true;
				if($resort_map) {
					$resort_map_filename = "resortmaps/" . $context->xpath("Resort/code")[0] . "_Map.jpg";
					$resort_map_alttext = "Resort Map for " . $context->xpath("Resort/name")[0];
					echo htmlspecialchars($resort_map->asXML());
				} else {
					$resort_map_local = false;
					$resort_map_filename = $images[0]->image;
					$resort_map_alttext = $context->xpath("Resort/name")[0]. " " . $images[0]->caption . ". Things to do in " . $context->xpath("Resort/ResortAddress/city")[0] . ".";
				}
			?>
				<?php echo getImageTag($resort_map_filename, $resort_map_alttag, ['img-fluid onsite-img'], $resort_map_local); ?>
			</div>
		</div>
		<img class='activities-yelp-logo' src='<?php echo $GLOBALS["img_path"] . "Yelp_trademark_RGB_outline.png"; ?>'>
	</div>

	<?php
		$path = rtrim($_SERVER['REQUEST_URI'],'/');
		$urlArray = explode('/',$path);
		$page = end($urlArray);
	?>
	<script type="text/javascript">
		function activateActivityContainer(container, source) {
			$(".activities-list-container").css({
				"display": "none"
			});
			$(".activities-filter-button").css({
				"background-color": "#645f5a"
			});
			$(".activities-list-container-" + container).css({
				"display": "block"
			});
			$(".activities-menu-container").css({
				"display": "none"
			});
			$(".activities-map-container").css({
				"display": "none"
			});
			$(".onsite-img").css({
				"display": "none"
			});
			source.css({
				"background-color": "#79726c"
			});

			<?php if (count($context->xpath("//OSARowCollection/Row")) > 0) { ?>
			$("#onSiteActivities").on("click", function (e) {
				$('.activities-yelp-logo').hide();
				activateActivityContainer("onsite", $(this));
			});
			<?php } else { ?>
			$("#onSiteActivities").css({
				"background-color": "#dadada"
			});
			<?php } ?>

			if (container == "offsite") {
				$(".activities-menu-container").css({
					"display": "block"
				});
				$('.activities-interface').css({
					'margin-bottom': '0',
				});
			} else {
				$(".onsite-img").css({
					"display": "block"
				});
				$('.activities-interface').css({
					'margin-bottom': '3rem',
				});
			}
			$(".activities-map-container-" + container).css({
				display: "block"
			});
		}

		$("#offSiteActivities").on("click", function (e) {
			$('.activities-yelp-logo').show();
			activateActivityContainer("offsite", $(this));
		});

		var forceShowCaption = true;

		activateActivityContainer("offsite", $("#offSiteActivities"));
	</script>
	<?php
	echo horizontalBreak();
	include(dirname(__DIR__) . '/partials/google_map.php');
	include(dirname(__DIR__) . '/partials/yelp_console.php');
	}
	include(dirname(__DIR__) . '/partials/resort-scripts.php');
?>
