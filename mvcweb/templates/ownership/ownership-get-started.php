<?php
	include(dirname(__DIR__) . "/partials/ownership.php");
	include(dirname(__DIR__) . "/common.php");
	$heroTitle = "Your Vacation Future
Starts Here.";
	$heroContent = array(
		0 => new HeroContent(array(
			"contentTitle" => "call today!",
			"contentParagraph" => "With just a few minutes of your time, our experts can provide you with a customized vacation plan.
			Call <span itemprop='telephone'><a class='telephone-number' href='tel:+18003077312'>800-307-7312</a></span>"
		)),
		1 => new HeroContent(array(
			"contentTitle" => "Request Info",
			"contentParagraph" => "Interested in learning more about Marriott Vacation Club? Share a few details and we will contact you.",
			"buttonText" => "Request Info",
			"buttonHref" => "/request-information"
		))
	);
	echo heroElementTemplate($heroTitle, "ownership/DS1-P-024.jpg", "Couple relaxing in a cabana and enjoying tropical drinks. ", $heroContent);
	echo getWhatHappensNext();
	echo horizontalBreak(); ?>
