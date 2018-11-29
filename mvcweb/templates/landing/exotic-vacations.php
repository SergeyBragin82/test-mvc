<?php
	// Y Draw enrollment
?>
<style type="text/css" media="screen">
	.hero-element-info-header {
		padding-bottom: 0;
		font-size: 31px;
		text-transform: capitalize;
	}

	.hero-element-info-subheader {
		padding: 0 1rem .5rem;
		font-size: 18px;
		color: #159486;
	}

	<?php // Overridding flexbox because Firefox doesn't support fluid video in flex'd element ?>
	.ydraw .row {
		display: block;
		overflow: hidden;
	}

	.ydraw [class*="col-"] {
		float: left;
	}

	.ydraw .fluid-video {
		display: block;
	    position: relative;
	    height: 0;
	    <?php // Calc needed to achieve proper ratio w/ bootstrap xl-8 column ?>
	    padding-top: calc(56.25% * 2 / 3);
	}

	.ydraw .fluid-video iframe {
		position: absolute;
		left: 0;
		top: 0;
		height: 100%;
		width: 100%;
	}

	.footer-element-divider,
	.ydraw .legal-code {
		display: none;
	}

	.legal-footer {
		position: relative;
	}

	.legal-footer .legal-code {
		position: absolute;
		right: 20px;
		transform: translateY(-300%);
		color: #645f5a;
	}

	@media (max-width: 1200px) {
		.ydraw .fluid-video {
			padding-top: 56.25%;
		}

		.ydraw .fluid-video iframe {
			left: 50%;
			transform: translateX(-50%);
		}
	}
</style>
<div class="y-draw-enrollment ydraw">
	<div class="container-fluid hero-element">
		<div class="row">
			<div class="col-xl-4">
				<div class="hero-element-info">
					<h1 class="hero-element-info-header">Explore Adventures in Exotic Locations</h1>
					<!-- <h2 class="hero-element-info-subheader">Enjoy a new world of adventures</h2> -->
					<div class="break">
						<hr>
					</div>
					<div class="hero-element-info-body">
						<div id="infoFormDescription">
							<p>Start living the adventures of a lifetime with the Marriott Vacation Club Destinations<sup>&reg;</sup> Program. From the plains of the Serengeti in Africa to the ancient treasures of Beijing, China, to breathtaking views on a romantic Alaskan cruise, you can choose from virtually endless options &ndash; this year and every year.</p>
							<span id="legalCode" class="legal-code">MG-18-156</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-8 fluid-video">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/MABeuU_xLps?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div><!-- / .fluid-video -->
		</div><!--  / .row -->
	</div><!--  / .hero-element -->
</div><!--  / .ydraw -->

<script>
	$(function(){
		$('#legalCode').prependTo('.legal-footer')
	})();
</script>