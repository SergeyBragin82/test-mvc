<?php
	// Y Draw enrollment
?>
<style type="text/css" media="screen">
	.brand-color{
		color: #009687;
	}
	
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
	
	.hero-element-info-body .page-content p{
		margin-bottom: 20px !important;
	}
	
	.image-container{
		height: 350px;
	}
	.image-container img{
		margin-top: 0;
		width: 100% !important;
	}
	@media (min-width:300px) and (max-width: 350px) {
		.image-container{
			height: 120px;
			overflow: hidden;
		}
		.image-container img{
			margin-top: 0;
		}
	}
	@media (min-width:349px) and  (max-width: 500px) {
		.image-container{
			height: 205px;
			overflow: hidden;
		}
		.image-container img{
			margin-top: -80px;
		}
	}
	
	@media (min-width:499px) and (max-width: 800px) {
		.image-container{
			height: 250px;
			overflow: hidden;
		}
		.image-container img{
			margin-top: -180px;
		}
	}
	
	@media (min-width:799px) and (max-width: 1130px) {
		.image-container{
			overflow: hidden;
		}
		.image-container img{
			margin-top: -220px;
		}
	}
	
	@media (min-width:1129px) and (max-width: 1199px) {
		.image-container{
			overflow: hidden;
		}
		.image-container img{
			margin-top: -125px;
		}
		.offer-note{
			margin-top: 10px !important;
		}
	}
	
	@media (min-width: 1200px) {
		.image-container{
			height: auto;
		}
		.image-container img{
		}
		.offer-note{
			margin-top: -15px !important;
		}
	}
</style>
<div class="y-draw-enrollment ydraw">
	<div class="container-fluid hero-element">
		<div class="row">
			<div class="col-xl-4">
				<div class="hero-element-info">
					<h1 class="hero-element-info-header">Let Us Steer You to More Fun</h1>
					
					<div class="break">
						<hr>
					</div>
					
					<div class="hero-element-info-body">
						<div class="page-content">
							<p class="brand-color">Avis customers receive a $100 American Express Gift Car</p>
							
							<p>Attendance at a 90 minute timeshare sales presentation is required. Gift card will be provided following the completion of the sales presentation.</p>
							
							<p>See below for details of participation.</p>
							
							<p>Call <a href="tel:8006921424">800-692-1424</a></p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-8 image-container">
				<img src="/wp-content/images/landing/avis/40615_Hero.jpg" />
			</div><!-- / .image-container -->
		</div><!--  / .row -->
		
		
		<div>
			<br/>
		</div>
		
		
		<div class="row">
			<!-- mobile content -->
			<div class="col-xl-6 d-block d-xl-none">
				<div class="hero-element-info" style="margin-top: 0; padding-top: 0;">
					<div class="hero-element-info-body">
						<div class="page-content">
							<p class="brand-color" style="font-weight: bold;">UNFORGETTABLE VACATION EXPERIENCES</p>
							
							<p>With destinations as expansive as your imagination and experiences as diverse as your ever-changing needs, Marriott Vacation Club can help you live the vacation lifestyle with the Marriott Vacation Club Destinations program.</p>
							
							<p>Enjoy spacious accommodations at more than 50 properties in the U.S. and around the world. Set sail on popular ships from leading cruise lines. Or explore an African safari or the Amazon rainforest. If you can dream, we can help you do it! Conditions and Participation Requirements Apply. Click her for details of participation.</p>
							
							<p>Call <a href="tel:8006921424">800-692-1424</a></p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-6 image-container">
				<img src="/wp-content/images/landing/avis/40615_cruise.jpg" />
			</div><!-- / .image-container -->
			
			<!-- desktop content -->
			<div class="col-xl-6 d-none d-xl-block">
				<div class="hero-element-info" style="margin-top: 0; padding-top: 0;">
					<div class="hero-element-info-body">
						<div class="page-content">
							<p class="brand-color" style="font-weight: bold;">UNFORGETTABLE VACATION EXPERIENCES</p>
							
							<p>With destinations as expansive as your imagination and experiences as diverse as your ever-changing needs, Marriott Vacation Club can help you live the vacation lifestyle with the Marriott Vacation Club Destinations program.</p>
							
							<p>Enjoy spacious accommodations at more than 50 properties in the U.S. and around the world. Set sail on popular ships from leading cruise lines. Or explore an African safari or the Amazon rainforest. If you can dream, we can help you do it! Conditions and Participation Requirements Apply. Click her for details of participation.</p>
							
							<p>Call <a href="tel:8006921424">800-692-1424</a></p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-12 offer-note text-xs-center text-sm-center text-md-center text-lg-center text-xl-right">
				<small><p>This offer is presented solely by Marriott Vacation Club International.</p></small>
			</div>
		</div><!--  / .row -->
		
		
							
		<span id="legalCode" class="legal-code">MDC-18-236</span>
	</div><!--  / .hero-element -->
</div><!--  / .ydraw -->

<script>
	$(function(){
		$('#legalCode').prependTo('.legal-footer')
	})();
</script>