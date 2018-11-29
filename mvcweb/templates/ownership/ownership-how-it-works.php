<?php
	include(dirname(__DIR__) . "/partials/ownership.php");
	$heroTitle = "Live It, Love It, <br> Own It";
	$heroElements = array(
		0 => new HeroContent(array(
			"contentTitle" => "how does ownership work",
			"contentParagraph" => "When you become a Marriott Vacation Club Destinations<sup>®</sup> Owner, you receive an annual allotment of Vacation Club Points. These are the \"currency\" you use to turn your vacation dreams into a reality for you and your loved ones."
)),
);
	$contentItem = array(
		0 => new ColumnItemContent(array(
			'imgPath' => 'ownership/hammock_425x319.jpg',
			'imgAlt' => 'Woman relaxing a a pool of flowers.',
			'contentHeader' => 'Replenished Every Year',
			'contentParagraph' => 'Vacation Club Points provide you with unparalleled flexibility and choice so you can relax, explore and discover your ideal vacation lifestyle every year. For life.',
		)),
		1 => new ColumnItemContent(array(
			'imgPath' => 'ownership/iStock-478316285.jpg',
			'imgAlt' => 'Woman having fun under in a waterfall.',
			'contentHeader' => 'Bank & Borrow for Even
	More Flexibility',
			'contentParagraph' => 'Planning an epic getaway? You can bank this year’s Vacation Club Points for use next year &mdash; or borrow from next year to book a reservation this year. You can even do both at once. Now that’s flexibility!',
		)),
		2 => new ColumnItemContent(array(
			'imgPath' => 'ownership/ownershipCruise.jpg',
			'imgAlt' => 'Cruise ship sailing in Alaska.',
			'contentHeader' => 'Add More at Any Time',
			'contentParagraph' => 'Expand your vacation lifestyle by adding Vacation Club Points at any time. Enjoy more vacations, bigger vacations, unforgettable experiences and a vacation life well lived.',
		)));
	echo heroElementTemplate($heroTitle, "ownership/KLV-LP-023_4_3.jpg", "Picture of a girl and her father playing in a pool.", $heroElements);
?>
<div class='ownership ownership-how'>
	<div class='ownership-body-element'>
		<h2 class='ownership-body-title-text' style='padding-top: 1rem;'>
			Vacation club points
		</h2>
		<div class='ownership-how-points'>
			<?php echo columnListItemWithPicture($contentItem) ?>
		</div>
	</div>
	<?php echo horizontalBreak(); ?>
	<div class='ownership-body-element'>
		<h2 class='ownership-body-title-text'>
			seeing is believing
		</h2>
		<p>
		Let's put those Vacation Club Points to work. Adjust the slider to see the wealth of vacation options that may be available to you.<sup>*</sup>
	</p>
		<div class='ownership-how-points-slider-container container'>
			<div class='row'>
				<div class='col-md-12 mx-5 px-0'>
					<h3 class='ownership-how-points-slider-label'>
					</h3>
					<div id="ownership-slider" class='ownership-how-points-slider'></div>
					<?php
						for($i=1;$i<7;$i++) {
							?>
							<div class="point-slider-level" style="left:<?php echo 100*(($i)/7.0)?>%;">
								<div id="hiw-pip-<?php echo $i;?>" class="point-slider-grey-dash"></div>
							</div>
							<?php
						}
					?>
				</div>
				<div class="clearfix mb-5">&nbsp;</div>
			</div>
		</div>
		<div class='container text-center'>
			<h3 class='ownership-how-points-title'>
				<span class="secondary-color" id="options-counter"></span> vacation options
			</h3>
			<p>
			These are just a handful of vacation options based on your selection.
		</p>
		</div>
		<div class='container-fluid resort-preview-container'>
			<div class='row' id='destinations-container'>
				<div id="destination-template" style="display:none;" class='col-lg-4'>
					<div class='resort-preview-parent'>
						<img src="" class="image"/>
						<div class='info-container pb-3'>
							<div class='info-accent'></div>
							<div class="readmore-resort-description">
								<h3 class='title'>
								</h3>
								<h5 class='location'>
								</h5>
								<ul class='resort-elements'>
									<li class='summary'>
									</li>
									<li class='type'>
									</li>
								</ul>
								<!--<br>-->
								<div class='text'>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<p>
			<sup>*</sup>And remember, by banking and borrowing Vacation Club Points, even more vacation options are possible.
		</p>
	</div>

	<?php echo horizontalBreak(); ?>
	<div class='ownership-body-element'>
		<div class='ownership-lifestyle-container'>
			<h3 class='ownership-body-title-text' id="vacationLifestyle">
				Start Living the Vacation Lifestyle
			</h3>

			<p style='white-space: pre-line;'>With thousands of options to choose from, there’s a world of vacation opportunities available to you. But with the world at your feet, where do you begin? The next step is for us to design a custom Vacation Club Points package based on your needs. As your tastes, family and preferences change over time, so will your definition of the ‘ideal’ vacation and we will be there to greet you with a diverse offering of high-quality experiences around the world.

Vacation Club Points packages begin at approximately $21,000.<sup>**</sup>

If you purchase from the comfort of your home, you will receive the best available incentives and savings.

<sup>**</sup>Additional closing costs apply. Annual ownership association fees and club dues are required. Financing may be available to qualified applicants.

	</p>
		</div>
	</div>
	<?php echo horizontalBreak(); ?>
</div>
<script type="text/javascript">
	var experiences = [];
	var pointLevel = "";
	var experiencesLevel;
	var pointLookup = [];
	var pointLevelCopy = [	"1,500 %vcp",
							"Up to 2,000 %vcp",
							"Up to 3,000 %vcp",
							"Up to 3,999 %vcp",
							"From 4,000 to 6,999 %vcp",
							"From 7,000 to 9,999 %vcp",
							"From 10,000 to 14,999 %vcp",
							"15,000 %vcp and above"];
	var optionsCount = [
		"2,391",
		"3,217",
		"4,681",
		"5,423",
		"6,406",
		"7,056",
		"7,799",
		"9,360"
	];
	<?php

		function clean_data($data) {
			return addslashes(str_replace("\n","<br/>", $data));
		}
		foreach($context->xpath("//Experience") as $experience) {
			$pointLevel = $experience->xpath("@PointsUpper")[0];
			$pointLevelLower = $experience->xpath("@PointsLower")[0];
	?>

		if (experiences["<?php echo $pointLevel; ?>"]==null) {
			experiences["<?php echo $pointLevel; ?>"] = [];
			console.log("creating for pointlevel: <?php echo $pointLevelLower . " - " . $pointLevel; ?>");
			pointLookup.push("<?php echo $pointLevel; ?>");
		}
		experiencesLevel = experiences["<?php echo $pointLevel; ?>"];
		var experience = {
			LongDesc: "<?php 
				$longDesc = $experience->xpath("@LongDesc");
				if (isXmlNodeValid($longDesc)) {
					echo clean_data($longDesc[0]);
				} else {
					echo "";
				}
				?>
				",
			ShortDesc: "<?php 
				$shortDesc = $experience->xpath("@ShortDesc");
				if (isXmlNodeValid($shortDesc)) {
					echo clean_data($shortDesc[0]);
				}
				?>",
			Points: "<?php 
				$points = $experience->xpath("@Points");
				if (isXmlNodeValid($points)) {
					echo clean_data($points[0]);
				}
			 ?>",
			ImageMainURL: "<?php 
				$image = $experience->xpath("@ImageMainURL");
				if (isXmlNodeValid($image)) {
					echo $image[0];
				}
				 ?>",
			Location: "<?php
				$location = $experience->xpath("@Location");
				if (isXmlNodeValid($location)) {
					echo clean_data($location[0]);
				}
				 ?>",
				SummaryArr: String("<?php
						$summary = $experience->xpath("@SummaryArr");
						if (isXmlNodeValid($summary)) {
							echo clean_data($summary[0]);
						}
				?>").split('t1234'),
				UnitType: "<?php
						$unitType = $experience->xpath("@UnitType");
						if (isXmlNodeValid($unitType)) {
							echo clean_data($unitType[0]);
						}
					?>",
		};
		experiencesLevel.push(experience);
	<?php
		}
	?>



	$(function() {
		pointLookup.sort(function(a, b) { return a-b;});
		var slider = $('#ownership-slider').slider({
			min: 0,
			max: 7,
			range: 'min',
			step: 1,
			slide: function(event, ui) {
				populateByPoints(ui.value);
			}
		});

		var destinations_template = template = $('#destination-template');
		function populateByPoints(pointIndex) {
			var points = pointLookup[pointIndex];
			var experience_level = experiences[points];
			var container = $("#destinations-container");
			$(".ownership-how-points-slider-label").html(pointLevelCopy[pointIndex].replace("%vcp", "Vacation Club Points"));
			for(var i=1; i<7;i++) {
				var pip = $("#hiw-pip-" + i);
				if(i<=pointIndex) {
					pip.removeClass("point-slider-grey-dash");
					pip.addClass("point-slider-teal-dash")
				} else {
					pip.removeClass("point-slider-teal-dash");
					pip.addClass("point-slider-grey-dash")
				}
			}
			$("#options-counter").html(optionsCount[pointIndex]);
			container.empty();
			experience_level.forEach(function(experience) {
				var experience_template = destinations_template.clone(true);
				experience_template.attr("id", null);
				experience_template.css("display", "flex");
				experience_template.css("height", "auto");
				experience_template.find(".title").html(experience.ShortDesc);
				experience_template.find(".image").attr("src", "https://www.marriottvacationclub.com/wp-content/images/sct_content/" + experience.ImageMainURL);
				experience_template.find(".image").attr("alt", "Image of " + experience.ShortDesc + " ");
				experience_template.find(".text").html(experience.LongDesc);
				//experience_template.find(".location").html(experience.Location);
				// var summaryArr = experience.SummaryArr;
				// if (summaryArr) {
				// 	var summaryNode = experience_template.find(".summary");
				// 	var typeNode = experience_template.find(".type");
				// 	var arrLength = summaryArr.length;
				// 	summaryNode.css({
				// 		display: 'list-item',
				// 	}).html(summaryArr[0]);
				// 	if (arrLength >= 3) {
				// 		typeNode.css({
				// 			display: 'list-item',
				// 		}).html(summaryArr[1]);
				// 	}
				// }
				container.append(experience_template);
				experience_template.find (".readmore-resort-description").readmore({ speed: 500, moreLink: '<div class="text-center read-more-btn"><a href="#" class="btn marriott-btn">READ MORE</a></div>', lessLink: '<div class="text-center read-more-btn"><a href="#" class="btn marriott-btn">CLOSE</a></div>'});
				});
				setupReadMore();
		}



		populateByPoints(0);
	});

</script>
<script src="<?php echo $GLOBALS['asset_path'] . 'javascript/ownershipHowToSlider.js'?>">
</script>