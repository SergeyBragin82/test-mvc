<?php
	include(dirname(__DIR__) . "/classes/hero_content.php");
	$heroTitle = "A World of Amazing New Opportunities Awaits";
	$heroContent = array(
		0 => new HeroContent(array(
			"contentParagraph" => "<p>Marriott Vacation Club<sup>&reg;</sup> is part of an expanding family of brands that now includes Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club — continuing our commitment of delivering premier vacation experiences worldwide. </p><br /><p>As part of this exciting expansion, you can enjoy the following when you become a Marriott Vacation Club Owner:</p>"
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
.15pxAll {
	background-color: red;
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
							<h3 class='header'>Elevated Marriott Rewards<sup>&reg;</sup> Status</h3>
						</div>
						<div class="description">
							As a Marriott Vacation Club Owner, you may be eligible to receive Elite status in the Marriott Rewards program through the Marriott Vacation Club Destinations Exchange Program. 
						</div><br /><br />
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
									New Brands and Destinations Worldwide through Marriott Rewards
								</h3>
								<div class='description'>
									<p>When you become an Owner, you can experience new brands and destinations through Marriott Rewards points earned from your Marriott Vacation Club ownership   — all while enjoying the benefits of your elevated status. You can now use your Marriott Rewards points to stay at more than 6,500 hotels across 29 unique brands, including The Ritz-Carlton<sup>&reg;</sup>, St. Regis, Marriott<sup>&reg;</sup> Hotels, Westin and W Hotels.<sup>1</sup></p>
								</div>
								<div class="note" style="font-size:10px;color:#343a40;">
									<sup>1</sup><i>Excludes timeshare locations.</i>
								</div><br />
							</div>
							<div class='item'>
								<h3 class='header'>
									Save 25% on Rental Stays
								</h3>
								<div class='description'>
									<p>As an Owner, you will receive 25% off available nightly rental rates at Marriott Vacation Club resorts. And now, with our expanding family of brands, you’ll receive the same 25% off available nightly rental rates at Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club locations, subject to availability and terms and conditions.<sup>2</sup></p>
								</div>
								<div class="note" style="font-size:10px;color:#343a40;">
									<sup>2</sup><i>For direct villa reservations and not applicable for Getaways offers through Interval International.</i>
								</div><br />
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
									More Savings on Vacation
								</h3>
								<div class='description'>
									When you become an Owner, you can ask for exclusive Owner discounts on select food, beverage and activity options at participating outlets while vacationing at Marriott Vacation Club, Sheraton<sup>&reg;</sup> Vacation Club and Westin<sup>&reg;</sup> Vacation Club locations, subject to terms and conditions.
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
	

<script>
$('button.hamburger').remove() 
</script>
