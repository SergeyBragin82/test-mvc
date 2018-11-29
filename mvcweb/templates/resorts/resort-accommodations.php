<?php
	$pageType = "Accomodations";
	$bookingHeader = $context->xpath('//villaAccomodationHeading')[0];
  	$bookingParagraph = $context->xpath('//villaAmentiesIntro')[0];	
	$carouselImages = array();
	$images = $context->xpath('Resort/resort_imagery/image[section="Accommodations"]');
	foreach($images as $image) {
		$carouselImages[] = (object)(array(
			'imgPath' => $image->image,
			'imgAltTag' => $bookingHeader . " " . $image->caption . ". Resort room options and floorplans.",
			'imgCaption' => $image->caption
		));
	}
	include(dirname(__DIR__) . '/partials/resort.php');
	include(dirname(__DIR__) . '/classes/resort_villa.php');

	$floorplanCollection = $context->xpath("//FloorPlan");
	$villaCollection = $context->xpath('//VilaOptions');
	function sortByVillaOptionTabOrder($option1, $option2) {
		$option1TabOrder = (int)$option1->xpath('villaOptionTabOrder')[0];
		$option2TabOrder = (int)$option2->xpath('villaOptionTabOrder')[0];
		return $option1TabOrder < $option2TabOrder ? -1 : 1;
	}
	usort($villaCollection, "sortByVillaOptionTabOrder");
	?>
	<div class='resort-accomodations mt-0'>
				<div id="villaDetailsTemplate" class="villa-details col-lg-4" style="display:none;">
					<div class="villa-details-header-container pl-3 pr-3">
						<div class="villa-details-header-container-info pt-0 mt-0">
							<img class="villa-details-icon mr-3 ml-3" width="35"/>
							<div class="villa-details-copy d-block">
								<h5 class="villa-details-header"></h5>
								<h6 class="villa-details-subheader"></h6>
							</div>
						</div>
					</div>
					<div class="villa-details-header-flavor-crystal"></div>
					<div class="villa-details-details"></div>
				</div>
			<div class='container-fluid villa-content-container'>
				<?php if (count($villaCollection) > 0) { ?>
				<div class="villas-menu">
					<h2 class='villas-menu-title'>
						accommodation options
					</h2>
					
					<select class='resort-dropdown' id="destinationDropdownList" onchange="refreshVillaContainer();" style="background-image: url(<?php echo $GLOBALS['img_path'] . 'dropdownArrowResort.png' ?>); <?php if (count($villaCollection)==1) { ?> display: none; <?php } ?>">
									<i class='icon-rounded-down'></i>
											<?php
										foreach($villaCollection as $idx => $villa) {
											?>
													<option value="<?php echo $villa->villaOptionTabOrder; ?>"><?php echo $villa->villaTypeHeading; ?></option>
											<?php
										}
									?>
								</select>

					<?php if (count($villaCollection)==1) { ?>
						<h4><?php echo $villaCollection[0]->villaTypeHeading; ?></h4>
					<?php } ?>
				</div>
				<div class='container-fluid villa-detail-container' id="container_template">
					<div class='villa-details-row row'>
						<div class='col-lg-4'>
							<div class='villa-list'>

							</div>
						</div>
					</div>
				</div>

					<?php } else {
						$villaWorkaround = $context->xpath("//VilaAmenities")[0];
						if($villaWorkaround) {
							?>
							<div class="villas-menu pb-0">
								<h2 class='villas-menu-title'>
									accommodation options
								</h2>
							</div>
							<div class="container-fluid">									
								<div class="row mt-0">
									<div class="col-lg-4 mx-auto">
										<h3 class="pl-4 pt-4"><?php echo $villaWorkaround->villaDiningHeading; ?></h3>
										<?php echo $villaWorkaround->villaDiningOverview; ?>
									</div>
								</div>
							</div>
						
							<?php
						}
					 } ?>
				<div class='villa-header-container'>
					<div class='header-text'>
						<?php echo($villa->villaHeader); ?>
					</div>
				</div>

		<?php if(count($floorplanCollection) > 0 && !(count($floorplanCollection)==1&&$floorplanCollection[0]->xpath("Media/description")[0]=="No-Floorplan-Available.jpg")) {?>
		<div class='container-fluid mx-0 px-0'>
			<div class="villas-menu">
				<h2 class='villas-menu-title'>
					floorplans
				</h2>
				<select class='resort-dropdown' id="floorplanDropdownList" onchange="refreshFloorplanContainer();" style="background-image: url(<?php echo $GLOBALS['img_path'] . 'dropdownArrowResort.png' ?>); <?php if (count($floorplanCollection)==1) { ?> display: none;<?php } ?>">
					<i class='icon-rounded-down'></i>
							<?php
						foreach($floorplanCollection as $idx => $floorplan) {
							?>
									<option value="<?php echo $idx; ?>"><?php echo $floorplan->xpath("Media/description")[0]; ?></option>
							<?php
						}
					?>
				</select>
				<?php if (count($floorplanCollection)==1) { ?>
					<h4><?php echo $floorplanCollection[0]->xpath("Media/description")[0]; ?></h4>
				<?php } ?>
			</div>
			<div class="text-center pt-5">
				<img class="floorplan_image mx-auto img-fluid"/>
			</div>
		</div>
		<?php } ?>
	</div>
<?php echo horizontalBreak(); ?>
</div>
<script>
	var forceShowCaption = true;
</script>
<?php
	include(dirname(__DIR__) . '/partials/resort-scripts.php');

	$path = rtrim($_SERVER['REQUEST_URI'],'/');
	$urlArray = explode('/',$path);
	$page = end($urlArray);
?>
<script language="javascript">
	villas = [];
	floorplans = [];
	prefix = "<?php echo $GLOBALS['img_path'];?>";
	<?php
		foreach ($villaCollection as $idx => $villa) {
			?>
			var villa = {
				details: []
			};
			villas.push(villa);
			
			<?php 
				$details = $villa->xpath('VilaDetailsCollection/VilaDetails');
				foreach ($details as $detail) {
					?>
					var detail = {
									title: "<?php echo htmlspecialchars(preg_replace('~[[:cntrl:]]~', '', strtoupper($detail->xpath("title")[0]))); ?>",
									subheader: "<?php echo htmlspecialchars($detail->xpath("subheader")[0]); ?>",
									detail: "<?php echo htmlspecialchars(preg_replace('~[[:cntrl:]]~', '', $detail->xpath("list")[0])); ?>"
								}
					villa.details.push(detail);
				<?php }
		}

		foreach ($floorplanCollection as $idx => $floorplan) {
			?>
			floorplans.push({
				floorplanImage: "https://owners.marriottvacationclub.com<?php echo htmlspecialchars($floorplan->xpath("Media/URL")[0]); ?>",
				floorplanAltText: "<?php echo htmlspecialchars($floorplan->xpath("Media/altText")[0]); ?>",
			});
			<?php
		}		
	?>

	jQuery.fn.insertAt = function(index, element) {
	  var lastIndex = this.children().size();
	  if (index < 0) {
	    index = Math.max(0, lastIndex + 1 + index);
	  }
	  this.append(element);
	  if (index < lastIndex) {
	    this.children().eq(index).before(this.children().last());
	  }
	  return this;
	}

	function refreshVillaContainer() {
		villaIndex = $("#destinationDropdownList").prop("selectedIndex");
		villa = villas[villaIndex];

		row = $(".villa-details-row");

		if (villa) {
			row.empty();
			var details = [];
			villa.details.forEach(function (e) {
				var template = $("#villaDetailsTemplate").clone(true);
				template.attr("id", null);
				var txt = document.createElement("textarea");
				txt.innerHTML = e.title;
				header = template.find(".villa-details-header")
				header.html(txt.value);
				txt.innerHTML = e.detail;

				template.find(".villa-details-details").html(txt.value);
				template.css({display: "block"});

				subheader = template.find(".villa-details-subheader");
				if(e.subheader!="") {
					subheader.html(e.subheader);	
					subheader.css({"margin-bottom": "0px"});
				} else {
					subheader.remove();
					header.css({"margin-bottom": "0px"});
					header.css({"margin-top": ".5rem"});
				}
				

				icon = "bed";
				childIndex = 0;

				e.title = e.title.toUpperCase();

				if(e.title.indexOf("KITCHEN AMENITIES")>=0 || e.title.indexOf("BATHROOM AMENITIES")>=0) {
					icon = "stove";
					childIndex = 2;
				} if(e.title.indexOf("GENERAL AMENITIES")>=0 || e.title.indexOf("RESORT AMENITIES")>=0) {
					icon = "alarm";
					childIndex = 1;
				} if(e.title.indexOf("UPON REQUEST")>=0 || e.title.indexOf("ROOM ENTERTAINMENT")>=0) {
					icon = "hanger";
					childIndex = 3;
				} 

				template.find(".villa-details-icon").attr("src", "/wp-content/plugins/mvcweb/assets/images/" + icon + ".svg");
				template.attr("index", childIndex);
				details.push(template);
			});

			details.sort(function (a, b) {
				return parseInt($(a).attr("index")) - parseInt($(b).attr("index"));
			})

			$.each(details, function (idx, item) { row.append(item)});
		}		
	}

	function refreshFloorplanContainer() {
		villaIndex = $("#floorplanDropdownList").prop("selectedIndex");
		console.log("debug info: " + villaIndex);
		$(".floorplan_image").attr("src", floorplans[villaIndex].floorplanImage);
	}

	// start with the first villa
	$(document).ready(function () {
		refreshVillaContainer();
		refreshFloorplanContainer();
	});
</script>
