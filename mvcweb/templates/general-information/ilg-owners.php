<?php
	include(dirname(__DIR__) . "/classes/hero_content.php");
	$heroTitle = "A World of Amazing New Opportunities Awaits";
	$heroContent = array(
		0 => new HeroContent(array(
			"contentParagraph" => "<p>Marriott Vacations Worldwide<sup>SM</sup>, with its three outstanding brands, Marriott Vacation Club<sup>&reg;</sup>, The Ritz-Carlton Destination Club<sup>&reg;</sup> and Grand Residences by Marriott<sup>SM</sup>, has recently acquired ILG, the parent company of the developer and operator of Sheraton<sup>&reg;</sup> Vacation Club, Westin<sup>&reg;</sup> Vacation Club and St. Regis Residence Club.</p><br /><p>This is an exciting time as we grow our brands, and we want to share this excitement by offering expanded opportunities to our valued Members.</p>"
		))
	);
	echo heroElementTemplate($heroTitle, "inspiration/ILGMVC-Autstralia_Victoria_GreatOceanRoad_12Apostles.jpg", "Vacation Your Way", $heroContent);

	?>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

<style>
.faqs .item .header {
    font-size: 18px;
    color: #159486;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: calc((100* 1em)/ 1000);
}
ul.faqs, ol.faqs{
	padding-left: 30px;
}
.faq-panel p a {
	color: #159486;
}
h6 {
	font-weight: bold;
}
.15px {
	padding:15px;
}
.15pxleft {
	padding-left:15px;
}
th {
	background-color: #5f5f5f;
	color: #fff;
	font-weight: normal;
	padding: 10px 15px;
	text-align: center;
}
table th:nth-of-type(1) {
	text-align: left;
}
td {
	color: inherit;
	font-weight: normal;
	padding: 8px 15px;
	font-size: .8em;
}
tr.alternate {
	background-color: #f8f8f6;
}
[data-toggle="collapse"]:before {
display: inline-block;
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
	padding: 5px;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  content: "\f054";
  transform: rotate(90deg) ;
  transition: all linear 0.25s;
  }   
[data-toggle="collapse"].collapsed:before {
  transform: rotate(0deg) ;
}
@media only screen and (max-width: 600px) {
    table td:nth-of-type(3) {
        border-left: 2px solid #ececec;
        border-right: 2px solid #ececec;
    }
	table th:nth-of-type(3){
		border-left: 2px solid #585858;
        border-right: 2px solid #585858;
		border-top: 2px solid #fff;
	}
	table th {
		font-size: 12px;
		text-align: center;
	}
	.15px {
		padding: 5px !important;
	}
	.15pxleft {
		padding-left:5px !important;
	}
}
@media only screen and (max-width: 400px) {
    table td:nth-of-type(3), table th:nth-of-type(3){
        border-left: 2px solid #ececec;
        border-right: 2px solid #ececec;
    }
	table th {
		font-size: 11px;
		text-align: center;
	}
}
.card-header a {
     color: #159486;
}
</style>
<div class="ownership-about">
	<div class="ownership-about-element">
		<div class='ownership-about-element-content' style="background-color:#f8f8f6;">
			<div class='container-fluid'>
				<div class='row'>
					<div class="col-xl-3" style="padding-right:10px;">
						<div class="item">
							<h3 class='header'>Enjoy Elevated Marriott Rewards<sup>&reg;</sup> Status</h3>
						</div>
						<div class="description">
							<p>As a Member of Marriott Vacation Club Destinations Exchange Program, at the Select, Executive, Presidential or Chairman's Club benefit level, your Elite status in the Marriott Rewards program is now upgraded.  So, with our expansion, Members with Marriott Rewards Gold Elite status will be elevated to Platinum Elite status, and Members with Platinum Elite status will be elevated to Platinum Premier Elite status. </p> 
						</div>
						<div class="description">
							<p>In addition, Members of Marriott Vacation Club Destinations Exchange Program currently at the Owner benefit level will be upgraded to Gold Elite status in February, 2019.    The benefits just got better, and with your new status, you'll enjoy these outstanding features:<sup class="note" style="font-size:10px;color:#343a40;">1</sup></p>
						</div><br />
						<div class="note" style="font-size:10px;color:#343a40;">
							<sup>1</sup><i>For those who have attained this status previously, there are no further impacts to your membership.</i>
						</div><br />
					</div>
					<div class="col-xl-9 15pxleft">
						<table width="100%" style="background-color:#fff; border: 2px solid #fff;">
							<tr>
								<th>Marriott Rewards Benefits at a Glance</th>
								<th width="20%">Gold Elite</th>
								<th width="20%">Platinum Elite</th>
								<th width="22%">Platinum Premier Elite</th>
							</tr>
							<tr>
								<td>Complimentary In-Room Internet Access<br /><i>Enhanced Internet (where available)</i></td>
								<td class="icon-circle" style="font-size: 11px; color:#e8c51c; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr class="alternate">
								<td>Member Rates</td>
								<td class="icon-circle" style="font-size: 11px; color:#e8c51c; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr>
								<td>Mobile Check-In/Services</td>
								<td class="icon-circle" style="font-size: 11px; color:#e8c51c; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr class="alternate">
								<td>Ultimate Reservation Guarantee</td>
								<td class="icon-circle" style="font-size: 11px; color:#e8c51c; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr>
								<td>Marriott Rewards Points Bonus</td>
								<td style="text-align:center; font-weight:bold;">25%</td>
								<td style="text-align:center; font-weight:bold;">50%</td>
								<td style="text-align:center; font-weight:bold;">75%</td>
							</tr>
							<tr class="alternate">
								<td>Priority Late Check-out *Based on Availability</td>
								<td style="text-align:center; font-weight:bold;">2pm</td>
								<td style="text-align:center; font-weight:bold;">4pm</td>
								<td style="text-align:center; font-weight:bold;">4pm</td>
							</tr>
							<tr>
								<td>Dedicated Elite Reservation Line</td>
								<td class="icon-circle" style="font-size: 11px; color:#e8c51c; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr class="alternate">
								<td>In-Hotel Welcome Gift<sup>&#8224;</sup> *Varies by Brand</td>
								<td class="icon-circle" style="font-size: 11px; color:#e8c51c; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr>
								<td>Enhanced Room Upgrade <br /><i>*Based on Availability</i></td>
								<td style="text-align:center; valign:top;"><span class="icon-circle" style="font-size: 11px; color:#e8c51c;">&nbsp;</span><br />&nbsp;</td>
								<td style="text-align:center; valign:top;"><span class="icon-circle" style="font-size: 11px; color:#7b969f;">&nbsp;</span><br />(Including Suites)</td>
								<td style="text-align:center;"><span class="icon-circle" style="font-size: 11px; color:#009687;">&nbsp;</span><br />(Including Suites)</td>
							</tr>
							<tr class="alternate">
								<td>Lounge Access <br /><i>*Where Available</i></td>
								<td>&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr>
								<td>Guaranteed Room Type</td>
								<td>&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#7b969f; text-align:center;">&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr class="alternate">
								<td>48-Hour Guarantee room availability (subject to limitations)</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td class="icon-circle" style="font-size: 11px; color:#009687; text-align:center;">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" style="padding:20px 15px;"><i>* Most benefits are for hotels only and not available at Marriott Vacation Club<sup>&reg;</sup>, Grand Residences by Marriott<sup>SM</sup>, The Ritz-Carlton Club<sup>&reg;</sup>, Sheraton<sup>&reg;</sup> Vacation Club, Westin<sup>&reg;</sup> Vacation Club or St. Regis Residence Club properties.</i>
								<br />
								<br /><sup>&#8224;</sup> In-Hotel Welcome gift for Gold Elite status is currently Marriott Rewards points.
								</td>
						</table>
					</div>
				</div>
			</div><br />
		</div>
	<?php echo horizontalBreak(); ?>
		
		<div class='ownership-about-element'>
			<div class='container-fluid'>
				<div class='row'>
					<div class="col-xl-6 image-col" style="margin: 50px 0px 0px;">
						<?php echo getImageTag('ownership/KBC-P-152_MainPool_rgb.jpg', 'Families laughing and eating at picnic tables outdoors sharing family vacation moments. ', array(0 => 'img-fluid'), true); ?>
					</div>
					<div class="col-xl-6">
						<div class='ownership-about-element-content' style="padding:0rem 2rem 0 !important;">
							<div class='item'><br />
								<h3 class='header'>
									Discover New Brands and Destinations Worldwide Through Marriott Rewards
								</h3>
								<div class='description'>
									Previously, Marriott Rewards points earned from your Marriott Vacation Club ownership were only eligible to use at Marriott<sup>&reg;</sup> branded hotels.  Now you'll have opportunities to use your Marriott Rewards points at more than 6,500 hotels, across 29 unique brands where you'll enjoy elevated Elite benefits and status recognition.<sup class="note" style="font-size:10px;color:#343a40;">2</sup>  Consider all of the places your elevated status can take you:  exciting destinations at hotels under The Ritz-Carlton<sup>&reg;</sup>, St. Regis, Marriott and Starwood brands.
								</div>
								
								<br />
								<div class="note" style="font-size:10px;color:#343a40;">
									<sup>2</sup><i> Excludes timeshare locations.</i>
								</div>
							</div>
							<div class='item'>
								<h3 class='header'>
									Save 25% on Rental Stays
								</h3>
								<div class='description'>
									You currently receive a villa rental discount exclusively at Marriott Vacation Club resorts. Now, with the unification of Marriott Vacations Worldwide and ILG, you will also receive the current 25% villa rental discount at all available Westin<sup>&reg;</sup> Vacation Club and Sheraton<sup>&reg;</sup> Vacation Club locations, subject to terms and conditions.<sup>3</sup>
								</div>
								<br />
								<div class="note" style="font-size:10px;color:#343a40;">
									<sup>3</sup><i> For direct villa reservations and not applicable for Getaway offers through Interval International.</i>
								</div>
							</div>
							<div class='item' id='expandedRentalDiscounts'>
								
								<div class='description'>
									<span>To take advantage of this offer:</span>
								</div>
								
								<div class='description'>
									<style>
										ol.expandedOffer{
											padding-left: 20px;
											font-size: 12px;
										}
										ol.expandedOffer li:before {
											position: relative;
											left:-10px;
										}
									</style>
									<ol class="expandedOffer">
										<li>Go to Marriott.com</li>
										<li>Type in your desired Destination</span></li>
										<li>Choose your desired travel dates</span></li>
										<li>Select Corporate/Promo from the Special Rates drop-down menu</span></li>
										<li>Use code: 14974 (Use for Westin<sup>&reg;</sup> Vacation Club and Sheraton<sup>&reg;</sup> Vacation Club)</li>
										<li>Click Find Hotels</li>
									</ol>
								</div>
							</div>
								
			<div class="card-image">
                <!--Accordion wrapper-->
                <div class="accordion md-accordion accordion-5" id="accordionEx5" role="tablist" aria-multiselectable="true">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="heading36">
                            <a data-toggle="collapse" data-parent="#terms" href="#collapse36" aria-expanded="false" aria-controls="collapse36">
                                
                                    Terms & Conditions
                            </a>
                        </div>

                    <!-- Accordion card -->
                    <div class="card mb-4 faqs">
                        <!-- Card body -->
                        <div id="collapse36" class="faq-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading36" data-parent="#terms">
                            <div class="card-body rgba-black-light white-text z-depth-1">
							
								<p><strong>Owner Rental Discount:</strong> Rental discounts in the amount of 25% off the available nightly rental rate at Marriott Vacation Club, Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club resorts are only available to Owners and Members of the Marriott Vacation Club, Sheraton<sup>&reg;</sup> Vacation Club, Westin<sup>&reg;</sup> Vacation Club, Grand Residences by Marriott, The Ritz-Carlton Club, and St. Regis Residence Club, subject to availability.  Owner must be present at check-in and there is a limit of two villas per Owner per night.  Discount may be greater for Marriott Vacation Club Owners at Marriott Vacation Club resorts based on Owner benefit level.  Only one discount may be applied per reservation.  Offer may be modified or terminated at any time.</p>
                            </div>
                        </div>
					</div>
				</div>
			</div>
                    </div>
                    <!-- Accordion card -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php echo horizontalBreak(); ?>
	
		<div class='ownership-about-element'>
			<div class='container-fluid'>
				<div class='row'>
					<div class="col-xl-6">
						<div class='ownership-about-element-content'>
							<div class='item'>
								<h3 class='header'>
									Get More Savings on Vacation
								</h3>
								<div class='description'>
									Another added value to your vacation ownership is certain exclusive food, beverage, and activity discounts and specials you receive while staying at participating Marriott Vacation Club resorts.  This benefit is expanding for you to now enjoy also at participating Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club locations, subject to terms and conditions.
								</div>
							</div>
						
			<div class="card-image">
                <!--Accordion wrapper-->
                <div class="accordion md-accordion accordion-5" id="accordionEx5" role="tablist" aria-multiselectable="true">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="heading37">
                            <a data-toggle="collapse" data-parent="#terms" href="#collapse37" aria-expanded="false" aria-controls="collapse37">
                                
                                    Terms & Conditions
                            </a>
                        </div>

                    <!-- Accordion card -->
                    <div class="card mb-4 faqs">
                        <!-- Card body -->
                        <div id="collapse37" class="faq-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading37" data-parent="#terms">
                            <div class="card-body rgba-black-light white-text z-depth-1">
							
                                <p><strong>On-site Discounts:</strong> Discounts for Owners and Members of Marriott Vacation Club<sup>&reg;</sup>, Sheraton<sup>&reg;</sup> Vacation Club, Westin<sup>&reg;</sup> Vacation Club, Grand Residences by Marriott<sup>&reg;</sup>, The Ritz-Carlton Club<sup>&reg;</sup> and St. Regis Residence Club interests are available at participating outlets of select Marriott Vacation Club, Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club resorts. Discounts vary by site, are not guaranteed and may be modified or terminated at any time. Owners should check to see what discounts may be available at the time of check-in.</p>

                            </div>
                        </div>
					</div>
				</div>
			</div>
						</div>
					</div>
					<div class="col-xl-6 image-col">
						<?php echo getImageTag('ownership/HH_Family_Picnic.jpg', 'Senior couple having coffee picnic break on a beach vacation. ', array(0 => 'img-fluid'), true); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php echo horizontalBreak(); ?>
	<br />
<div id="FAQtarget">	
<div class="container">
	<h5 class='' id='privacyTitle'>
    Frequently Asked Questions
	</h5>
</div>
	<br />
<!-- Card -->
<div class="card-image">

    <!-- Content -->
    <div class="rgba-black-strong px-4">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-xl-9">

                <!--Accordion wrapper-->
                <div class="accordion md-accordion accordion-5" id="accordionEx5" role="tablist" aria-multiselectable="true">

                    <!-- Accordion card -->
                    <div class="card mb-4 faqs">

					<div class="" id="rewardstatus">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="heading30">
                            <a data-toggle="collapse" data-parent="#rewardstatus" href="#collapse30" aria-expanded="true" aria-controls="collapse30">
                                
                                     ILG Acquisition Status
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse30" class="faq-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading30" data-parent="#rewardstatus">
                            <div class="card-body rgba-black-light white-text z-depth-1">
                                
				<div class="item">
					<h3 class='header'>ILG Acquisition Status</h3>
				</div><br />
								
				<h6>WHAT IS THE STATUS OF THE ACQUISITION OF ILG?</h6>
				<p>Marriott Vacations Worldwide (MVW) has acquired ILG in a cash and stock transaction with an implied equity value of approximately $4.7 billion as of the announcement date of April 30, 2018. The acquisition will create a leading global provider of premier vacation experiences.</p>
  
				<h6>WHO IS ILG?</h6>
				<p>ILG is a leading provider of premier vacation experiences with over 40 properties and more than 250,000 owners in its Sheraton<sup>&reg;</sup> Vacation Club, Westin<sup>&reg;</sup> Vacation Club and other vacation ownership portfolios. ILG also has exchange networks comprising nearly two million members and over 3,200 resorts worldwide, including our longstanding exchange partner, Interval International<sup>&reg;</sup>.</p>
  
				<h6>WHY DID MVW ACQUIRE ILG?</h6>
				<p>This transaction has brought together two industry-leading companies with properties in some of the most highly demanded vacation destinations, including popular vacation locations in Mexico and the Caribbean. With this acquisition, MVW now has over 100 vacation properties and more than 20,000 vacation ownership units around the world. We will also be the global licensee of seven upper-upscale and luxury vacation brands including Marriott Vacation Club<sup>&reg;</sup>, Grand Residences by Marriott<sup>SM</sup>, The Ritz-Carlton Destination Club<sup>&reg;</sup>, Sheraton<sup>&reg;</sup> Vacation Club, Westin<sup>&reg;</sup> Vacation Club and St. Regis Residence Club.</p>
				
				<h6>WILL THERE BE ANY CHANGES TO THE PRODUCT I CURRENTLY OWN OR PRICING?</h6>
				<p>We do not currently expect this transaction to result in any material changes to our products or pricing. With that said, it is early in the process and there are still many decisions to be made.</p>
  
				<h6>WILL I BE ABLE TO USE MY OWNERSHIP TO DIRECTLY RESERVE A VACATION AT Sheraton<sup>&reg;</sup> Vacation Club OR Westin<sup>&reg;</sup> Vacation Club RESORTS?</h6>
				<p>At this time, there will be no changes in MVW’s programs or products; however, we will continue to evaluate what, if any, additional benefits and services could potentially be made available in the future from our newly combined company.</p>
				<p>Of course, Owners and Members of Marriott Vacation Club, Marriott’s Grand Residences, Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club will continue to have access to the recently combined Marriott Rewards, Starwood Preferred Guest and The Ritz-Carlton Rewards loyalty programs. In addition, Owners and Members may still be eligible to stay across brands with a membership and exchange through Interval International.</p>
				<p>We will provide additional relevant information as decisions are made.</p>

				<h6>ARE THERE ANY OTHER POTENTIAL IMPACTS TO MY OWNERSHIP AS A RESULT OF THE ACQUISITION OF ILG?</h6>
				<p>We are pleased to announce that Owners and Members will experience some immediate advantages with their ownership, which include upgraded Marriott Rewards and Ritz-Carlton Rewards benefits for eligible Owners and Members, new rental discounts at Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club properties and select on-site resort discounts. </p>
							</div>
                        </div>
					</div>
					<div class="" id="upgradedbenefits">
                        <!-- Card header -->
                        <div class="card-header" role="tab" id="heading31">
                            <a data-toggle="collapse" data-parent="#upgradedbenefits" href="#collapse31" aria-expanded="true" aria-controls="collapse31">
                                
                                    Marriott Rewards<sup>&reg;</sup> Upgraded Benefits
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse31" class="faq-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading31" data-parent="#upgradedbenefits">
                            <div class="card-body rgba-black-light white-text z-depth-1">
                                <div class="item">
					<h3 class='header'>Marriott Rewards<sup>&reg;</sup> Upgraded Benefits</h3>
				</div>
				<br />
				
				<h6>ARE THERE CHANGES TO THE MARRIOTT REWARDS PROGRAM?</h6>
				<p>Beginning August 18, the following Marriott Rewards Elite Upgrades were provided by Owner benefit level to eligible Owners and Members that have not already attained this status.
					<ul class="faqs">
						<li>Select & Executive: Marriott Rewards Platinum Elite Status</li>
						<li>Presidential & Chairman’s Club: Marriott Rewards Platinum Premier Elite Status</li>
					</ul>
				In addition, we’re pleased to announce that if you are at the Owner benefit level of Owner, you will now receive a Gold Elite membership.
				</p>
				
				<h6>I AM A WEEK(S) OWNER OR MEMBER WITHOUT AN OWNER BENEFIT LEVEL. WILL I RECEIVE A MARRIOTT REWARDS UPGRADE?</h6>
				<p>The Marriott Rewards upgrade is being provided to those Owners and Members who own Vacation Club Points or who have enrolled in the Marriott Vacation Club Destinations Exchange Program. If you have not enrolled, you might consider enrolling to receive this additional benefit. You can learn more about the benefits of enrolling when you visit our Enrollment webpage <a href="https://owners.marriottvacationclub.com/timeshare/mvco/enroll">here</a>. </p>
				
				<h6>I HAVE AN OWNER BENEFIT LEVEL OF OWNER. WHEN WILL I RECEIVE MY NEW GOLD ELITE MEMBERSHIP?</h6>
				<p>We anticipate this to take place in February of 2019.</p>
				
				<h6>NEW OWNERS ARE RECEIVING THEIR MARRIOTT REWARDS GOLD ELITE STATUS AFTER CLOSING. AS AN EXISTING OWNER AT THE OWNER LEVEL, WHY DO I HAVE TO WAIT UNTIL 2019 TO RECEIVE MY MARRIOTT REWARDS GOLD ELITE STATUS?</h6>
				<p>We annually review Marriott Rewards account status for Owners and Members based on their current ownership and make recommended upgrades at this time. New Owners and Members are awarded their initial status as part of their purchase process. </p>
				
				<h6>IF THERE ARE MULTIPLE OWNERS OR MEMBERS ON AN ACCOUNT, WHO WILL RECEIVE THE MARRIOTT REWARDS STATUS UPGRADE?</h6>
				<p>The primary Owner or Member listed on the account will receive the account upgrade. This can be reassigned during the annual account review process.</p>
				
				<h6>WILL I RECEIVE A MARRIOTT REWARDS STATUS UPGRADE FOR EACH OF MY ACCOUNTS?</h6>
				<p>No. Only one Marriott Rewards status upgrade will be awarded per ownership grouping. </p>
				
				<h6>WILL I RECEIVE ANY ADDITIONAL MARRIOTT REWARDS BENEFITS AT THIS TIME?</h6>
				<p>Previously, Marriott Rewards points earned from your Ownership or Membership were only eligible for use at Marriott branded hotels. Now you’ll have even more opportunities to use your Marriott Rewards points at more than 6,500 hotels across 29 unique brands where you may enjoy elevated Elite benefits and status recognition. You can visit exciting destinations at hotels under the distinctive Ritz-Carlton, St. Regis, Marriott and Starwood brands.</p>
				
				<h6>WHEN ARE MARRIOTT VACATION CLUB OWNERS GOING TO BE ABLE TO USE THEIR MARRIOTT VACATION CLUB EARNED MARRIOTT REWARDS POINTS TO BOOK STARWOOD HOTEL PROPERTIES?</h6>
				<p>Marriott Vacation Club Owners and Members began to use these Marriott Rewards points across all brands on August 18.</p>
				
				<h6>WHAT IF I HAVE OTHER QUESTIONS ABOUT MARRIOTT REWARDS?</h6>
				<p>Please visit <a href="https://www.marriott.com/rewards/rewards-program.mi">Marriott Rewards</a>  for details.</p>
				
                            </div>
                        </div>
					</div>
					<div class="" id="rentaldiscounts">
                        <!-- Card header -->
                        <div class="card-header" role="tab" id="heading32">
                            <a data-toggle="collapse" data-parent="#rentaldiscounts" href="#collapse32" aria-expanded="false" aria-controls="collapse32">
                                
                                    Resort Rental Discounts
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse32" class="faq-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading32" data-parent="#rentaldiscounts">
                            <div class="card-body rgba-black-light white-text z-depth-1">
                                
				<div class="item">
					<h3 class='header'>Resort Rental Discounts</h3>
				</div>
				<br />
				
				<h6>WILL THERE BE ANY CHANGES TO RENTAL DISCOUNTS AT VACATION OWNERSHIP RESORTS?</h6>
				<p>Yes. You will now receive the current 25% rental discount at Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club (as well as Marriott Vacation Club) properties based on availability, subject to terms and conditions. </p>
				
				<h6>HOW DOES THIS DISCOUNT IMPACT THOSE WITH OWNER BENEFIT LEVELS OF EXECUTIVE, PRESIDENTIAL OR CHAIRMAN’S CLUB?</h6>
				<p>The current rental discount will remain the same at Marriott Vacation Club resorts. The rental discount for all Owners and Members is currently 25% at Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club resorts, subject to terms and conditions.
</p>
				
				<h6>HOW WILL THIS DISCOUNT BE APPLIED TO A RENTAL RESERVATION?</h6>
					
									<ol class="faqs">
										<li>Go to Marriott.com</li>
										<li>Type in your desired Destination</span></li>
										<li>Choose your desired travel dates</span></li>
										<li>Select Corporate/Promo from the Special Rates dropdown menu</span></li>
										<li>Use code: 14974 (Use for Westin<sup>&reg;</sup> Vacation Club and Sheraton<sup>&reg;</sup> Vacation Club)</li>
										<li>Click Find Hotels</li>
									</ol>
				
				<h6>ARE THERE ANY RESTRICTIONS ASSOCIATED WITH THIS OFFER?</h6>
				<p>While there is currently no time limit on this rental discount, there are a few restrictions. Rental discounts at Marriott Vacation Club, Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club resorts are limited to two villas per Owner or Member per night. Also, the Owner or Member must be a member of the travel party checking in to receive the rental discount. Rental accommodations are subject to availability. This rental discount may be modified or terminated at any time; however, any previously confirmed reservations will be honored at the discounted rate. Only one discount may be applied per reservation. </p>
				
                            </div>
                        </div>
					</div>
					<div class="" id="resortdiscounts">
                        <!-- Card header -->
                        <div class="card-header" role="tab" id="heading33">
                            <a data-toggle="collapse" data-parent="#resortdiscounts" href="#collapse33" aria-expanded="false" aria-controls="collapse33">
                                
                                    On-site Resort Discounts
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse33" class="faq-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading33" data-parent="#resortdiscounts">
                            <div class="card-body rgba-black-light white-text z-depth-1">
                                <div class="item">
					<h3 class='header'>On-site Resort Discounts</h3>
				</div><br />
				
				<h6>WILL THE RESORT DISCOUNTS I CURRENTLY ENJOY CHANGE DUE TO THIS ACQUISITION?</h6>
				<p>The discounts are now being expanded. Marriott Vacation Club, The Ritz-Carlton Destination Club and Grand Residences by Marriott Owners and Members staying at Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club resorts will now receive certain site-based Owner and Member discounts at participating properties, subject to terms and conditions. </p>
				
				<h6>IS THERE AN EXPIRATION DATE TO THIS BENEFIT?</h6>
				<p>There is currently no time limit placed on these discounts; however, discounts will vary by resort and may be terminated or changed at any time.</p>
				
				<h6>DOES THIS DISCOUNT APPLY TO ME WHEN I RENT A VILLA ACROSS BRANDS?</h6>
				<p>Applicable resort discounts are available to Owners and Members staying on-site, at participating Marriott Vacation Club, Westin<sup>&reg;</sup> Vacation Club and Sheraton<sup>&reg;</sup> Vacation Club locations regardless of whether they are renting or using their Ownership/Membership rights.</p>
				
				<h6>HOW CAN I GET THIS DISCOUNT?</h6>
				<p>When you check in at a Marriott Vacation Club, Sheraton<sup>&reg;</sup> Vacation Club or Westin<sup>&reg;</sup> Vacation Club resort, just inquire at the front desk to see what discounts are available and how to redeem them.</p>
				
				<h6>WHEN WILL THE DISCOUNTS GO INTO EFFECT? </h6>
				<p>Both the rental and on-site discounts will begin with check-ins starting September 7, 2018.</p>
				
                            </div>
                        </div>
					</div>
					<div class="" id="communications">
                        <!-- Card header -->
                        <div class="card-header" role="tab" id="heading34">
                            <a data-toggle="collapse" data-parent="#communications" href="#collapse34" aria-expanded="false" aria-controls="collapse34">
                                
                                    Ongoing Communications
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse34" class="faq-panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading34" data-parent="#communications">
                            <div class="card-body rgba-black-light white-text z-depth-1">
                                
				<div class="item">
					<h3 class='header'>Ongoing Communications</h3>
				</div>
				<br />
				
				<h6>HOW CAN I KEEP UPDATED ON NEWS AND CHANGES? </h6>
				<p>It is our goal to keep you informed about any news related to this exciting new acquisition. We will update this Webpage, as information becomes available.  We will also utilize our normal communication channels, which may include email, social media and Owner or Member newsletters to convey news and updates.</p>
				
				<h6>WHO CAN I CONTACT IF I HAVE QUESTIONS?</h6>
				<p>If you have any questions, please do not hesitate to reach out to your resort operations team or Owner/Member Services.</p>
                            </div>
                        </div>
					</div>
                    <!-- Accordion card -->
				</div>
					
                </div>
                <!--/.Accordion wrapper-->

            </div>

        </div>



    </div>
    <!-- Content -->
</div>
<!-- Card -->
</div>
</div>
<script>
$('button.hamburger').remove() 
</script>
