
<?php
	include(dirname(__DIR__) . "/partials/ownership.php");
	$heroTitle = "Vacation Your Way.";
	$heroContent = array(
		0 => new HeroContent(array(
			"contentTitle" => "the benefits of ownership",
			"contentParagraph" => "There is such a thing as the perfect vacation &mdash; it just looks different for each of us. But there is one thing we can all agree on: vacation time is precious. That’s why we created timeshare ownership and exchange programs that help you make the most of every precious vacation moment."
		)),
	);
	echo heroElementTemplate($heroTitle, "ownership/ownershipCouple.jpg", "Couple toasting wine at a pool. Vacation your way. Discover the benefits of timeshare ownership. ", $heroContent);
?>
<div class="ownership-about">
	<div class='ownership-about-element'>
		<h2 class='ownership-about-element-title'>
			Choices &amp; Options
		</h2>
			<div class='container-fluid'>
				<div class='row'>
					<div class="col-xl-6 image-col">
						<?php echo getImageTag('ownership/mvc-hilton-head-170419-05439_4_3.jpg', 'Golfers driving their golf carts on vacation.  ', array(0 => 'img-fluid'), true); ?>
					</div>
					<div class="col-xl-6">
						<div class='ownership-about-element-content'>
							<div class='item'>
								<h3 class='header'>
									A WEALTH OF LOCATIONS AND EXPERIENCES
								</h3>
								<div class='description'>
									Choose from more than 10,000 vacation options, all with the high standards you’ve come to expect from the Marriott<sup>®</sup> brand.
								</div>
							</div>
							<div class='item'>
								<h3 class='header'>
									more control over your vacations
								</h3>
								<div class='description'>
									You aren’t limited to a specific time of year or home resort. Vacation as often as you want based on the number of Vacation Club Points you have and how you use them.
								</div>
							</div>
							<div class='item'>
								<h3 class='header'>
									more space to enjoy
								</h3>
								<div class='description'>
									From studios to 1-, 2- and 3-bedroom villas, you can choose the size that fits your travel party and vacation plans.
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo horizontalBreak(); ?>

	<div class='ownership-about-element'>
		<h2 class='ownership-about-element-title'>
			Peace of mind
		</h2>
			<div class='container-fluid'>
				<div class='row'>
					<div class="col-xl-6 image-col">
						<?php echo getImageTag('ownership/HH_Family_Picnic.jpg', 'Families laughing and eating at picnic tables outdoors sharing family vacation moments. ', array(0 => 'img-fluid'), true); ?>
					</div>
					<div class="col-xl-6">
						<div class='ownership-about-element-content'>
							<div class='item'>
								<h3 class='header'>
									A BRAND YOU CAN BELIEVE IN
								</h3>
								<div class='description'>
									For more than three decades, Marriott Vacation Club has pursued excellence and innovation, delivering unforgettable vacations as one of the most trusted brands in the timeshare industry.
								</div>
							</div>
							<div class='item'>
								<h3 class='header'>
									YOUR VACATION FUTURE IS SECURE
								</h3>
								<div class='description'>
									One of the main reasons people choose Ownership is that it makes vacationing a certainty throughout their lives rather than a just a possibility.
								</div>
							</div>
							<div class='item'>
								<h3 class='header'>
									Your Ownership Evolves with You
								</h3>
								<div class='description'>
									Because your family’s ideal vacation changes over time, how you use your ownership can evolve with your needs. You aren’t limited to a specific time or location and you can add more Vacation Club Points at any time.
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo horizontalBreak(); ?>

	<div class='ownership-about-element'>
		<h2 class='ownership-about-element-title'>
			and did you know...
		</h2>
			<div class='container-fluid'>
				<div class='row'>
					<div class="col-xl-6 image-col">
						<?php echo getImageTag('ownership/HH_Couple_Beach.jpg', 'Senior couple having coffee picnic break on a beach vacation. ', array(0 => 'img-fluid'), true); ?>
					</div>
					<div class="col-xl-6">
						<div class='ownership-about-element-content'>
							<div class='item'>
								<h3 class='header'>
									OWNERSHIP ENSURES YOU VACATION EVERY YEAR
								</h3>
								<div class='description'>
									And, when you compare renting a traditional hotel room to a stay in a villa that has amenities such as a full kitchen, you’ll quickly see the benefit of a timeshare resort.
								</div>
							</div>
							<div class='item'>
								<h3 class='header'>
									IT’S AN ASSET YOU CAN PASS ON
								</h3>
								<div class='description'>
									You will own a valuable asset, a deeded real estate interest, which can be enjoyed year after year and generation after generation.
								</div>
							</div>
							<div class='item'>
								<h3 class='header'>
									YOU ONLY PURCHASE THE TIME YOU NEED
								</h3>
								<div class='description'>
									Our personalized vacation ownership program lets you purchase Vacation Club Points according to your personal travel interests and needs.
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo horizontalBreak(); ?>
