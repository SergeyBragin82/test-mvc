<div class="container-fluid footer-container">
	<div class="row">
		<?php // If page is a /landing page, do not display this block ?>
		<?php if( false === strpos($_SERVER['REQUEST_URI'], '/landing')  && $context->xpath("//@ebrochure_mode")[0]!="true") { ?>
			<div class="col-sm-12 col-md-3 footer-content">
				<span class="footer-element-divider"></span>
				<h4>Connect with us</h4>
				<div class="social-icons">
					<a href="javascript: void(0);" onclick="javascript:attachLegalPopupToExternalLinks('https://www.instagram.com/marriottvacationclub/')">
						<i class="icofont icofont-social-instagram"></i>
					</a>
					<a href="javascript: void(0);" onclick="javascript:attachLegalPopupToExternalLinks('https://twitter.com/marriottvacclub')">
						<i class="icofont icofont-social-twitter"></i>
					</a>
					<a href="javascript: void(0);" onclick="javascript:attachLegalPopupToExternalLinks('https://www.facebook.com/MarriottVacationClub')">
						<i class="icofont icofont-social-facebook"></i>
					</a>
					<a href="javascript: void(0);" onclick="javascript:attachLegalPopupToExternalLinks('https://www.pinterest.com/marriottvacclub/')">
						<i class="icofont icofont-social-pinterest"></i>
					</a>
					<a href="javascript: void(0);" onclick="javascript:attachLegalPopupToExternalLinks('https://www.youtube.com/user/MarriottVacationClub')">
						<i class="icofont icofont-social-youtube-play'"></i>
					</a>
					<a href="javascript: void(0);" onclick="javascript:attachLegalPopupToExternalLinks('https://www.linkedin.com/company/6859/')">
						<i class="icofont icofont-social-linkedin"></i>
					</a>
					<a href="javascript: void(0);" onclick="javascript:attachLegalPopupToExternalLinks('https://plus.google.com/114458484867016951297')">
						<i class="icofont icofont-social-google-plus"></i>
					</a>
				</div>
				<a class="btn marriott-btn" href="/request-information" role="button" id='requestInfoDesktopFooter'>
					request info
				</a>
				<div class="phone-footer">
					<p>or Learn More
						<?php echo phoneNumberTemplate($defaultPhoneNumber, $defaultPhoneNumberDisplayString); ?>
					</p>
				</div>
			</div>
		<?php } // if( false !== strpos($_SERVER['REQUEST_URI'], '/landing') ) ?>

		<div class="col-sm-12 col-md-3 footer-content">
			<?php if ($context->xpath("//@ebrochure_mode")[0]!="true") { ?>
				<span class="footer-element-divider footer-content"></span>
			<?php } ?>
			<h4>company information</h4>
			<ul class="footer-list">
				<li>
					<a href="//www.marriottvacationsworldwide.com/company/about-us.shtml" target='_blank'>
						Corporate Info
					</a>
				</li>
				<?php if ($context->xpath("//@ebrochure_mode")[0]!="true") { ?>
				<li>
					<a href="/newsroom">
						Newsroom
					</a>
				</li>
				<?php } ?>
				<li>
					<a href="/careers">
						Careers
					</a>
				</li>
				<?php if ($context->xpath("//@ebrochure_mode")[0]!="true") { ?>
				<li>
					<a href="/contact-us">
						Contact Us
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<div class="col-sm-12 col-md-3 footer-content">
			<?php if ($context->xpath("//@ebrochure_mode")[0]!="true") { ?>
				<span class="footer-element-divider"></span>
			<?php } ?>
			<h4>legal information</h4>
			<ul class="footer-list">
				<li>
					<a href="/state-and-legal-disclosures">
						State and Legal Disclosures
					</a>
				</li>
				<li>
					<a href="/privacy">
						Privacy Policy
					</a>
				</li>
				<li>
					<a href="/terms-of-use">
						Terms of Use
					</a>
				</li>
			</ul>
		</div>

		<?php // If page is a /landing page, do not display this block ?>
		<?php if( false === strpos($_SERVER['REQUEST_URI'], '/landing') && $context->xpath("//@ebrochure_mode")[0]!="true") { ?>
			<div class="col-sm-12 col-md-3 footer-content">
				<h4>other link areas</h4>
				<ul class="footer-list">
					<li>
						<a href="/sitemap">
							Site Map
						</a>
					</li>
					<li>
						<a href='javascript:attachSweepstakesModal("https://marriottvacationclubaloha.dja.com/pages/registration.php?loc=IM59%2A1-FKXQET");'
						  target="_self">Sweepstakes</a>
					</li>
					<li>
						<a href="/faq" target='_blank'>
							FAQ
						</a>
					</li>
				</ul>
			</div>
		<?php } // if( false !== strpos($_SERVER['REQUEST_URI'], '/landing') ) ?>
	</div>
</div>
