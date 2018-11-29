<nav class="navbar navbar-expand-md navbar-dark justify-content-between fixed-header">
<?php if (count($context->xpath("//@ebrochure_mode"))==0||$context->xpath("//@ebrochure_mode")[0]!="true") { ?>	<a href='/' class='logo-href'> <?php } ?>
		<div class='logo'>
			<?php echo getImageTag('logoNew.svg', 'Marriott Vacation Club Logo', NULL, true); ?>
			<!-- <object type='image/svg+xml' data='<?php echo($GLOBALS['img_path'] . 'logoNew.svg'); ?>'>
				<?php echo getImageTag('logoNew.png', 'Marriott Vacation Club Logo', NULL, true); ?>
			</object> -->
		</div>
<?php if (count($context->xpath("//@ebrochure_mode"))==0||$context->xpath("//@ebrochure_mode")[0]!="true") { ?>	</a> <?php } ?>

<?php 
if (count($context->xpath("//@ebrochure_mode"))==0||$context->xpath("//@ebrochure_mode")[0]!="true") { ?>
	
		<?php // If page is a /landing page, do not display navbar ?>
		<?php if( false === strpos($_SERVER['REQUEST_URI'], '/landing') ) { ?>
			<div class="header-navbar" id="navbarNav">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item nav-link header-option header-navbar-dropdown" aria-haspopup="true" aria-expanded="false">
						<span alt='Ownership'>Ownership</span>
						<i class='icon-rounded-down'></i>
						<ul>
							<li>
								<a class='header-navbar-dropdown-option' href="/timeshare-ownership/about/">About Ownership</a>
							</li>
							<?php echo horizontalBreak(); ?>
							<li>
								<a class='header-navbar-dropdown-option' href="/timeshare-ownership/about-marriott-vacation-club/">About MVC</a>
							</li>
							<?php echo horizontalBreak(); ?>
							<li>
								<a class='header-navbar-dropdown-option' href="/timeshare-ownership/how-it-works/">How It Works</a>
							</li>
							<?php echo horizontalBreak(); ?>
							<li>
								<a class='header-navbar-dropdown-option' href="/timeshare-ownership/get-started/">How To Get Started</a>
							</li>
						</ul>
					</li>
					<li class="nav-item nav-link header-option header-navbar-dropdown" aria-haspopup="true" aria-expanded="false">
						<span alt='Destinations'>Destinations</span>
						<i class='icon-rounded-down'></i>
						<ul>
							<li>
								<a class='header-navbar-dropdown-option' href="/destinations/">Overview</a>
							</li>
							<?php echo horizontalBreak(); ?>
							<li>
								<a class='header-navbar-dropdown-option' href="/vacation-resorts/">MVC Resorts</a>
							</li>
							<?php echo horizontalBreak(); ?>
							<li>
								<a class='header-navbar-dropdown-option' href="/destinations/marriott-rewards/">Marriott Rewards</a>
							</li>
							<?php echo horizontalBreak(); ?>
							<li>
								<a class='header-navbar-dropdown-option' href="/destinations/exchange-partner-resorts/">Exchange Partner<br> Resorts</a>
							</li>
							<?php echo horizontalBreak(); ?>
							<li>
								<a class='header-navbar-dropdown-option' href="/destinations/explorer-collection/">Explorer Collection</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link header-option" href="/vacation-inspiration/" alt='Inspiration'>
							Inspiration
						</a>
					</li>
					<li class="nav-item header-option search-menu-container" aria-haspopup="true" aria-expanded="false">
						<!-- <?php get_search_form(); ?> -->
						<div class='search-menu-input-container'>
							<input class="search-menu-input" type="text" id="search_input_box" value="" placeholder="SEARCH" />
							<button class='search-icon' onclick="toggleMenuSearch(this, event);">
								<i class='icon-search2' aria-hidden="true"></i>
							</button>
							<!-- <input class='btn marriott-btn' type="submit" id="search_input_box_go" value="SEARCH"/> -->
						</div>
					</li>
				</ul>
				<a class="header-option owner-login" href="https://owners.marriottvacationclub.com/timeshare/mvco/owner/login" role="button"
				  data-action='login'>
					OWNER LOGIN
					<i class="icon-lock2" aria-hidden="true"></i>
				</a>
				<div class='header-info mx-0'>
					<div class='header-info-request mr-0'>
						learn more
						<?php echo phoneNumberTemplate($defaultPhoneNumber, $defaultPhoneNumberDisplayString); ?>
						<a class='marriott-btn ml-2' id='requestInfoBtnDesktop' href='/request-information/' role='button'>
							Request Info
						</a>
					</div>
				</div>
			</div>

		<?php } // if( false !== strpos($_SERVER['REQUEST_URI'], '/landing') ) ?>
	<?php } // if ($context->xpath("//@skip_nav")[0]!="true") ?>
</nav>
<nav class="mobile-menu" id="mobileMenu">
	<div class='mobile-menu-search'>
		<input type="text" id="search_input_box_mobile" value="" placeholder="SEARCH">
		<i class='icon-search2' aria-hidden="true"></i>
		</input>
	</div>
	<?php // If page is a /landing page, do not display menu ?>
	<?php if( false === strpos($_SERVER['REQUEST_URI'], '/landing') ) { ?>
		<ul class='mobile-menu-dropdown-ul'>
			<li class="mobile-menu-dropdown-li" aria-haspopup="true" aria-expanded="false">
				<div class='mobile-menu-dropdown-li-header'>
					<span>
					Ownership</span>
					<i class='icon-rounded-down'></i>
				</div>
				<div class='mobile-menu-options'>
					<ul>
						<li>
							<a class='mobile-menu-dropdown-option' href="/timeshare-ownership/about/">About ownership</a>
						</li>
						<li>
							<a class='mobile-menu-dropdown-option' href="/timeshare-ownership/about-marriott-vacation-club/">About MVC</a>
						</li>
						<li>
							<a class='mobile-menu-dropdown-option' href="/timeshare-ownership/how-it-works/">How It Works</a>
						</li>
						<li>
							<a class='mobile-menu-dropdown-option' href="/timeshare-ownership/get-started/">How To Get Started</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="mobile-menu-dropdown-li" aria-haspopup="true" aria-expanded="false">
				<div class='mobile-menu-dropdown-li-header'>
					<span>Destinations</span>
					<i class='icon-rounded-down'></i>
				</div>
				<div class='mobile-menu-options'>
					<ul>
						<li>
							<a class='mobile-menu-dropdown-option' href="/destinations/">Overview</a>
						</li>
						<li>
							<a class='mobile-menu-dropdown-option' href="/vacation-resorts/">MVC Resorts</a>
						</li>
						<li>
							<a class='mobile-menu-dropdown-option' href="/destinations/marriott-rewards/">Marriott Rewards</a>
						</li>
						<li>
							<a class='mobile-menu-dropdown-option' href="/destinations/exchange-partner-resorts/">Exchange Partner<br> Resorts</a>
						</li>
						<li>
							<a class='mobile-menu-dropdown-option' href="/destinations/explorer-collection/">Explorer Collection</a>
						</li>
					</ul>
				</div>
			</li>
			<li class='mobile-menu-dropdown-li'>
				<a href="/vacation-inspiration">
					<div class='mobile-menu-dropdown-li-header'>
						Inspiration
					</div>
				</a>
			</li>
			<li class='mobile-menu-dropdown-li'>
				<a href="/vacation-inspiration">
					<div class='mobile-menu-dropdown-li-header'>
						Inspiration
					</div>
				</a>
			</li>
		</ul>
		<a href='/request-information' role='button' id='requestInfoMobile'>
			<div class='mobile-menu-button'>
				Request Info
			</div>
		</a>
		<div class='mobile-menu-login'>
			<div class='login-items'>
				<a href="https://owners.marriottvacationclub.com/timeshare/mvco/owner/login" role='button' data-action='login'>
					Owner Login
				</a>
				<i class="icon-lock2"></i>
			</div>
		</div>
		<div>
		<?php echo phoneNumberTemplateMobileHeader($defaultPhoneNumber, $defaultPhoneNumberDisplayString) ?>
		</div>
		<div class='container text-center'>
			<div class='promotion-container'>
				<?php echo getImageTag('promotion/promotionBG.jpg', 'Receive a Bonus Vacation.', array(0=>'img-fluid', 1=>'mobile-menu-ad'), true); ?>
				<div class='promotion-info'>
					<h3 class='promotion-title'>Special Offer</h3>
					<h5 class='promotion-subtitle'>Receive A Bonus Vacation</h5>
					</div>
				<a class="btn marriott-btn" href="/request-information" role="button" id='promotionHeaderInfo'>
					Learn More
				</a>
			</div>
		</div>
	<?php } // if( false !== strpos($_SERVER['REQUEST_URI'], '/landing') ) ?>
</nav>
