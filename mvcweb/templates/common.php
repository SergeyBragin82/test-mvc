<?php
	function getMarriottQuality() {
		$contentItem = array(
			0 => new ColumnItemContent(array(
				'imgPath' => 'fire.jpg',
				'imgAlt' => 'View of an outdoor fireplace with ski gondolas in the background. ',
				'contentHeader' => 'World-Class Resorts',
				'contentParagraph' => 'Relax, play and get away for a memory-making get-together at any of our 50+ exceptional Marriott Vacation Club resorts, each designed to rejuvenate souls, connect families and enrich lives.',
				'buttonText' => 'SEE MVC RESORTS',
				'buttonHref' => '/vacation-resorts'
			)),
			1 => new ColumnItemContent(array(
				'imgPath' => 'beach.jpg',
				'imgAlt' => 'Young child drawing art shapes on a beach with her family playing in the ocean behind her. ',
				'contentHeader' => 'Specialty Travel & Experiences',
				'contentParagraph' => 'Browse our curated collection of vacation experiences and live a vacation life full of exploration and discovery, from cruises to safaris to private luxury vacation homes and more.',
				'buttonText' => 'SEE EXPLORER COLLECTION',
				'buttonHref' => '/destinations/explorer-collection'
			)),
			2 => new ColumnItemContent(array(
				'imgPath' => 'golf.jpg',
				'imgAlt' => 'Two friends teeing off at an ocean front golf course. Blue skies and palm trees in the background. ',
				'contentHeader' => 'Personalized Vacation Guidance',
				'contentParagraph' => 'Our vacation ownership advisors will help you get the most out of your vacation ownership. Their mission is to help you plan and experience unforgettable vacations year after year.',
				'buttonText' => 'CONTACT US',
				'buttonHref' => '/contact-us'
			)));

		$listItems = columnListItemWithPicture($contentItem);
		return <<<HTML
		<div class="container-fluid body-content" id="marriottQuality">
			<h2 class="kessel-header">
				guaranteed marriott quality
			</h2>
			<p style='padding-bottom: 2rem;'>When you explore the world the Marriott Vacation Club way, you get all the standards of excellence you’d expect from the most trusted brand in hospitality in the most desirable destinations all over the world.
			</p>
			$listItems
		</div>
HTML;
	}

	function getExperiencesItems() {
		$genericIcon = 'GenericIcon.png';
		$genericIconAlt = 'Generic List Icon';

		return listItem(
			'Over 50 World-Class Resorts',
			'Vacation at magnificent resorts throughout the U.S., Caribbean, Europe, Australia and Southeast Asia.',
			$genericIcon,
			$genericIconAlt
		) . listItem(
			'4,000+ Marriott<sup>&reg;</sup> Hotels ',
			'Enjoy the reliable excellence of Marriott-branded hotels around the globe.',
			$genericIcon,
			$genericIconAlt
		) . listItem(
			'Specialty Travel',
			'Gain access to guided tours, cruises, safaris, private luxury vacation homes and much more.',
			$genericIcon,
			$genericIconAlt
		) . listItem(
			'3,000+ Affiliated Resorts',
			'Expand your travel options even further through our premier external exchange partner, Interval International<sup>&reg;</sup>.<br><br>Marriott Hotels (through the Marriott Rewards Program), Specialty Travel, Exchange Partner Resorts and certain Marriott Vacation Club Resorts are available only through the Marriott Vacation Club Destinations Exchange Program.',
			$genericIcon,
			$genericIconAlt
		);
	}

	function getUnforgettableExperiences() {
		$actionList = getExperiencesItems();
		return <<<HTML
		<div class="container-fluid body-content" id='vacationExperiences'>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h2 class="kessel-header">
						unforgettable<br />vacation experiences
					</h2>
					<div class="title-description">
						<p>We’ve created one of the most exciting vacation timeshare programs available. As an Owner, you will have access to a vast and diverse collection of resorts, properties and experiences including cruises, adventure travel, guided tours and more. As your tastes and your family change over time, so will your ideal vacation. And we’ll be there to greet you with premium vacation experiences around the world.
					</p>
					</div>
					<a class="btn marriott-btn" href="/destinations" role="button">
						EXPLORE DESTINATIONS
					</a>
				</div>
				<div class="col-sm-12 col-md-6">
					<ul class="action-list">
						$actionList
					</ul>
				</div>
			</div>
		</div>
HTML;
	}

	function getWhatHappensNext() {
		return <<<HTML
		<div class='ownership-body-element' id='happensNext'>
			<h2 class='ownership-body-title-text' style='padding-top: 1rem;'>
				what happens next?
			</h2>
			<div class='ownership-started-container container-fluid'>
				<div class='row ownership-started-container-text'>
					<div class='col-xs-12 col-sm-12 col-md-4'>
						<div class='round-number'>
								1
							</div>
						<div class='info-text'>
							<p>
								When you contact us for information, a Marriott Vacation Club expert will give you a clear, simple overview of our program, answer any questions you have and guide you through vacation options based on your likes and interests.
							</p>
						</div>
					</div>
					<div class='col-xs-12 col-sm-12 col-md-4'>
					<div class='round-number'>
								2
							</div>
						<div class='info-text'>
							<p>
								Take as much or as little time as you need to explore Marriott Vacation Club with our experts. We respect your time and will give you the space you need to decide whether our program is right for you and your family. We can set times to talk based on your availability and convenience, and we can share information by email, too.
							</p>
						</div>
					</div>
					<div class='col-xs-12 col-sm-12 col-md-4'>
					<div class='round-number'>
								3
							</div>
						<div class='info-text'>
							<p>
							Based on your travel and vacation interests, our experts will provide you with a customized plan complete with current prices, incentives and savings.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
HTML;
	}
 ?>
