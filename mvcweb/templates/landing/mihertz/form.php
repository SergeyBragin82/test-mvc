<?php
$pagesection = "";
$isform = true;
include("header.php");
include("mobile_detect.php");
?>
<div>
<div class="header-desktop">
	<div class="form-header">
	      <a href="/landing/cc/offers?loc=<?php echo $loc_set;?>"><img class ="mlogo" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/marriott_logo_dark.svg"></a>
	      <a href="javascript:void();" data-toggle="sidebar">
	      		<img  width="35" height="35" class ="hamburgermenu" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/darkburger.svg">
	  		</a>
	  	</div>
	  	<div class="dark-grey-bg desktop-divider"></div>
	  </div>
	  <div class="header-mobile">
	  	<div class="p-2">
	  		<a href="/landing/cc/offers?loc=<?php echo $loc_set;?>">
	  	<img class ="mlogo" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/Marriott_logo_horiz.svg"></a>
	      <a href="javascript:void();" data-toggle="sidebar">
	      		<img width="35" height="35" class ="hamburgermenu" src="/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/hamburger.svg">
	  		</a>
	  	</div>

	  </div>
	</div>
<?php
//include(dirname(__DIR__) . '/../partials/carousel_widget.php');
include(dirname(__DIR__) . '/../partials/resort-common.php');
	$carouselImages = array();
	$mobile = new Mobile_Detect();
	$dir = "desktop";
	if(!$mobile->isMobile()) {
		$images = $context->xpath('//resort/images/image');
	} else {
		$dir = "mobile";
		$images = $context->xpath('//resort/mobile_images/image');
	}
	
	foreach($images as $image) {
		$carouselImages[] = (object)(array(
			'imgPath' => "/wp-content/plugins/mvcweb/assets/mvcweb/css/landing/mihertz/resorts/" . $dir . "/" . $image->xpath("@url")[0],
			'imgAltTag' => "Image",
			'imgCaption' => "Image"
		));
	}
 ?>
   <div class="resorttitle p-4">
   	<?php if ($context->xpath("//resort/name")[0]) {?>
   		<h1 class="text-center"><?php echo $context->xpath("//resort/name")[0]; ?></h1>
   	<?php } else { ?>
    <h1 class="text-center"><?php echo $context->xpath("//Resort/name")[0]; ?></h1>
	<?php }?>
	<?php if ($context->xpath("//resort/location")[0]) {?>
	<h2><?php echo $context->xpath("//resort/location")[0]; ?></h2>
	<?php } else { ?>
    <h2><?php echo $context->xpath("//Resort/ResortAddress/city")[0] . ", " . $context->xpath("//Resort/ResortAddress/state")[0];?></h2>
	<?php } ?>
  </div>
<!-- 
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	<?php foreach($carouselImages as $idx => $image) {?>
    		<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $idx; ?>" <?php if ($idx==0) { ?>class="active"><?php } ?></li>
		<?php } ?>
  </ol>
  <div class="carousel-inner">
  	<?php
  	foreach($carouselImages as $idx => $image) {
  	?>
    <div class="carousel-item <?php if ($idx==0) { ?>active<?php } ?>">

      <img class="d-block carousel-image" src="<?php echo $image->imgPath; ?>" alt="<?php echo $image->imgAltTag; ?>"/>
    </div>
  	<?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true">
    	<i class="fg fa fa-chevron-left"></i>
    </span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" style="right: 0%; position: absolute;" aria-hidden="true">
    	<i class="fg fa fa-chevron-right"></i>
    </span>
  </a>
</div>
 -->
<?php $map_key = get_param("GOOGLE_MAPS_API_KEY"); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php print $map_key; ?>"></script>
<script type="text/javascript">
	function findZipCodeCityState() {
		var zipCode = $("#zipCodeInfoForm").val();
		$("#zipCodeError").css({display:"none"});

		if(isNaN(zipCode)||zipCode.length!=5) {
			$("#zipCodeError").css({display:"block"});
			$(".form-submit").attr("disabled", null);
			return;
		}

		var geo = new google.maps.Geocoder();
		geo.geocode({
			componentRestrictions: {
				postalCode: zipCode
			},
			'language': 'en'
		}, function(results, status) {
			console.log(results);
			if (status === google.maps.GeocoderStatus.OK) {
				results[0].address_components.forEach(function(component) {
					if (component.types.indexOf('locality') >= 0) {
						$("#city").val(component['long_name']);
					} else if (component.types.indexOf('sublocality') >= 0) {
						$("#city").val(component['long_name']);
					}
					else if (component.types.indexOf('administrative_area_level_1') >= 0) {
						$("#state").val(component['short_name']);
					}
				});
			}

			if($("#city").val()=="" && $("#state").val()=="") {
				$("#zipCodeError").css({display:"block"});
				$(".form-submit").attr("disabled", null);
				return;
			} 

				var form = $("#ccInfoForm");
				var url = form.attr('action');

				$.ajax({
				   type: "POST",
				   url: "/wp-admin/admin-post.php",
				   data: form.serialize(), // serializes the form's elements.
				   success: function(data)
				   {
				       $("#thankyou").css({display: "block"});
				       $("#ccInfoForm").css({display: "none"});
				       satelliteTrack2('form complete');

				       <?php if ($mobile->isMobile()) { ?>
				       $([document.documentElement, document.body]).animate({
					        scrollTop: $("#thankyou").offset().top
					    }, 1000);
					   <?php } ?>
				   }
				 });
		})
	}
</script>
<div class="w-100 resortheader1 mt-3">
    <div class="row mx-0">
    <div class="col d-flex light-grey-bg resortdcopy-container p-2 mt-0">
		<div class="resortdcopy mx-auto mr-3 d-flex align-items-center">
			<h3 class="teal-fg mb-0">4&nbsp;DAYS,&nbsp;3&nbsp;NIGHTS &nbsp; NOW&nbsp;</h3><span class="teal-fg price-large"><?php echo $context->xpath("//price")[0];?></span>
		</div>
  	</div>
    <!-- <div class="col d-flex light-grey-bg p-4 ml-3 mt-0">
		<div class="align-self-center resortdprice mx-auto">
	      <h5 class="mb-0">FROM</h5>
	      <h2 class="teal-fg price-large"><?php echo $context->xpath("//price")[0];?><?php if ($context->xpath("//resort/legal")[0]) {?>*<?php } ?></h2>
	      <?php if ($context->xpath("//resort/legal")[0]) {?>
				<h6 class="belowmoneycopy"><?php echo $context->xpath("//resort/legal")[0];?></h6>
	      <?php }?> 
		</div>
  </div> -->
</div>
</div>
<div class="tealdiv mb-3 mt-0"></div>
<div class="choice-container white-bg">
<div class="container">
<div class="row">
	<div class="col-lg d-flex" >
		<div class="choice align-self-center">
    <h1>The Choice Is Yours.</h1>
    <h4><span class="vacayexperience">SELECT YOUR VACATION EXPERIENCE.</span></h4><br />
      <div class="goldline2 mb-4"></div>
    <h6><p class="callat">CALL US AT:</p></h6>
    <?php 
    	$phone = $context->xpath("//resort/phone")[0];

    	if($loc) {
    		$phone = $loc["main_" . $context->xpath("//resort/loc_code")[0] . "_phone"];
    	}

    	$telphone = "+1" . str_replace("-","", $phone);
    ?>
      <h5><p class="phone"><a href="tel:<?php echo $telphone; ?>" class="teal-fg"><?php echo $phone;?></a></p></h5>
      <span class="kessel">Or simply complete the form.</span><br/>
      <div class="d-block d-sm-block d-md-block d-lg-none mt-4">
		<div class="goldline2"></div>
	</div>
      <br/>
      <a class="teal-fg" href="/landing/cc/offers/details?loc=<?php echo $loc_set; ?>">Click here for Details of Participation</a>
</div>
	</div>
	<div class="col-lg">
<div class="flexdates mt-3 p-2">
	<h3 class="flexdatesheader ">FLEXIBLE TRAVEL DATES.</h3>
	<p>When you submit the form, a vacation specialist will contact you to help you purchase your vacation package and reserve the perfect dates for your vacation.</p>
</div>
<?php if ($_GET["form"]=="thankyou") {
?>
Thank You, we’ve received all your information and we’ll be in contact with you shortly!
<?php } else { ?>
<div id="thankyou" class="text-center" style="display:none">
	<h1>Thank You!</h1>
	<p class="kessel-book">We’ve received all your information and we’ll be in contact with you shortly!</p>
</div>
<form id='ccInfoForm' method='post' action="#" class="p-2 mb-5 pb-3">
	<div id='firstStepInfoForm'>
		<div class="form-group">
			<input type="text" class="form-control" name="FIRST_NAME" id="firstNameInfoForm" aria-describedby="firstName" placeholder="First Name" required>
			<div class='invalid-feedback' id='firstNameError' style='display: none;'>
					Please provide a First Name.
			</div>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="LAST_NAME" id="lastNameInfoForm" placeholder="Last Name" required>
			<div class='invalid-feedback' id='lastNameError' style='display: none;'>
					Please provide a Last Name.
			</div>
		</div>
        <br/>
	</div>
		<div class="form-group">
		 <input type="text" class="form-control" name="PHONE" id="phoneInfoForm" aria-describedby="phoneNumber" placeholder="Phone" required>
		 <div class='invalid-feedback' id='phoneInfoError' style='display: none;'>
					Please provide a phone number.
			</div>
	 </div>
	 <div class="form-group">
		 <input type="email" class="form-control" name="EMAIL" id="emailInfoForm" placeholder="Email" required>
		 <div class='invalid-feedback' id='emailInfoError' style='display: none;'>
					Please provide a valid Email address.
			</div>
	 </div>
	<div class="form-group" id="zipCodeFormGroup">
		<input type="text" class="form-control" name="POSTAL_CD" id="zipCodeInfoForm" placeholder="Zip Code" required>
		 <div class='invalid-feedback' id='zipCodeError' style='display: none;'>
				Please provide a valid US Zip Code before proceeding.
		</div>
	</div>
	<input type="hidden" name="ORIGIN_LOC" value="<?php echo $_GET['loc']; ?>"/>
	<input type="hidden" name="FORM_LOC" value="<?php echo $_GET['fid']; ?>"/>
	<input type="hidden" name="CITY" value="" id="city"/>
	<input type="hidden" name="STATE_PROV" value="" id="state"/>
	<input type="hidden" name="action" value="hertz_resort_form"/>
	<input type="submit" class="form-submit px-5 py-2 text-center mx-auto" value="SUBMIT"/>

	 <div class="form-check mt-3">
			<label class="form-check-label" id='electionFormCheck'>
				<input type="checkbox" name='OPTIN' class="form-check-input">
				<div class="optindetails">YES!&nbsp;&nbsp;I would like to receive information about promotions from Marriott Vacation Club.
				</div>
			</label>
		</div>
</form>
<?php } ?>
</div></div></div></div>
<div class="teal-bg tealdiv my-0 desktop-divider"></div>
<?php if ( !empty( @$carouselImages[0] ) ): ?>
<div class="offer-image">
	<img class="prlx-img" src="<?php echo $carouselImages[0]->imgPath; ?>"/>
</div>
<?php endif; ?>
<div class="light-grey-bg text-center py-5">
	<?php
		$resortorhotel = $context->xpath("//ishotel")[0]=="true" ? "HOTEL" : "RESORT";
	?>
	<h1 class="about-header aboutresortheader baskerville" id="about">ABOUT THE <?php echo $resortorhotel; ?></h1>
	<div class="flavor-crystal teal-bg mx-auto my-3"></div>
	<p class="about-resort mx-auto kessel"><?php echo $context->xpath("//about")[0];?></p>
</div>
<?php if ( !empty( @$carouselImages[1] ) ): ?>
<div class="offer-image" style="z-index:-2;">
	<img class="prlx-img" src="<?php echo $carouselImages[1]->imgPath; ?>"/>
</div>
<?php endif; ?>
<div class="pt-5 text-center white-bg">
	<h2 class="attraction-header baskerville" id="attractions">AREA ATTRACTIONS</h2>
	<div class="flavor-crystal teal-bg mx-auto my-3"></div>
	<div class="about-resort mx-auto mt-4">
		<?php
		foreach($context->xpath("//attraction") as $attraction) {
			?>
			<div class="attr-container p-3 text-left mb-4">
				<h4 class="pb-3"><?php echo $attraction->xpath("@title")[0];?></h4>
				<h5 class="pt-2"><?php echo $attraction->xpath("@subtitle")[0];?></h5>
				<p><?php echo $attraction;?></p>
			</div>
			<?php
		}
		?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		_satellite.track('form start');
		//satelliteTrack2('form start');
		$('#ccInfoForm').submit(function() {
			$(".form-submit").attr("disabled", "disabled");
			var valid = validate("firstName") &&
						validate("lastName") &&
						validate("phone") &&
						validate("email") &&
						validate("zipCode");
			digitalData.pageInfo.pageName += " | Submit";
			if (valid) {
	    		findZipCodeCityState();
	    	}
		    return false; // return false to cancel form action
		});
		$('.carousel').carousel({interval: 2000});


		////// parallax images
		var jQWindow = $( window );
		$('.prlx-img').on('load',function(){
			var pos, scrollTop;
			var elemHeight, imgHeight, windowHeight, elemTop, maxScTop, minScTop;
 			var element = $(this);
 			var elemHeight = element.parent().outerHeight();
 			var imgHeight = element.outerHeight();
 			var windowHeight = jQWindow.outerHeight();
 			var elemTop = element.parent().offset().top;
 			var maxScTop = elemTop + elemHeight;
 			var minScTop = elemTop - windowHeight;

			jQWindow.resize( function() {
				if ( typeof element === 'undefined' ) return;
    			elemHeight = element.parent().outerHeight();
    			imgHeight = element.outerHeight();
    			windowHeight = jQWindow.outerHeight();
    			elemTop = element.parent().offset().top;
    			maxScTop = elemTop + elemHeight;
    			minScTop = elemTop - windowHeight;
    			if ( jQWindow.outerWidth() < element.outerWidth() ){
    				element.css({ left: ( jQWindow.outerWidth() - element.outerWidth() )/2 +'px' });
    			}
    			jQWindow.scroll();
			});
			
			jQWindow.scroll( function() {
				if ( typeof element === 'undefined' ) return;
				scrollTop = jQWindow.scrollTop();
				if( scrollTop < minScTop || scrollTop > maxScTop ) {
					// do nothing when image out of screen
				} else {
					pos = ( scrollTop - minScTop ) / ( elemHeight + windowHeight ) * (elemHeight - imgHeight);
					element.css({ top: pos+'px' });
				}
			});
			jQWindow.resize();
		}).each( function(){
			if(this.complete) $(this).load();
		});
		
	});

	

	function validate(form) {
		if($("#" + form + "InfoForm").val()=="") {
			$("#" + form + "Error").css({display: "block"});
			return false;
		} else {
			$("#" + form + "Error").css({display: "none"});
			return true;
		}
	}

	var decodeEntities = (function() {
	  // this prevents any overhead from creating the object each time
	  var element = document.createElement('div');

	  function decodeHTMLEntities (str) {
	    if(str && typeof str === 'string') {
	      // strip script/html tags
	      str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
	      str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
	      element.innerHTML = str;
	      str = element.textContent;
	      element.textContent = '';
	    }

	    return str;
	  }

	  return decodeHTMLEntities;
	})();

	function setTripAdvisorQuote(taData) {
		if (!taData.reviews) {
			return;
		}
		var filtered = taData.reviews.filter(function (review) {
			return review.rating >= 5;
		});
		var container = $('#taQuoteContainer');
		var containerCol = $('#quoteCol');
		var review = filtered[Math.floor(Math.random() * filtered.length)];
		var publishedDate = moment(review.published_date);
		var reviewText = review.text;
		var indexCutoff = Math.min(reviewText.length, 100);
		if (reviewText[indexCutoff] !== ' ') {
			indexCutoff = reviewText.indexOf(' ', indexCutoff);
		}
		reviewText = reviewText.substr(0, indexCutoff) + "...<span class='quote-more'>more</span>";
			var reviewContent =
			setupLegalPopup($('<a>').attr('href', review.url)
				.append(
					$('<blockquote class="ta-quote-content teal-border p-4">')
					.append($('<h4>').addClass('quote-title teal-fg').html(review.title))
					.append($('<p>').addClass('quote-text').html(reviewText))
					.append(
						$('<img>')
						.attr('src', review.rating_image_url)
					)
					.append(
						$('<span>')
						.addClass('quote-meta')
						.html(
							"Reviewed by a TripAdvisor traveler, " +
							publishedDate.format('MM/DD/YYYY')
						)
					)
				));
		container.fadeIn();
		$('<div class="quote-content">').appendTo(containerCol)
			.append(
				reviewContent
			);
	}

	function retrieveTripadvisorData() {
		api("/api/tripadvisor", "GET", {
			taCode: <?php echo json_encode((string)$context->xpath('//tripAdvisorCode')[0]); ?>
		}, function (result) {
			try {
				data = JSON.parse(result);
				if (data) {
					setTripadvisorReviews(data);
					setTripAdvisorQuote(data);
				}
			} catch (e) {
				console.error('error trying to parse json response', result);
			}
			
		});
	}


	function setTripadvisorReviews(taData) {
		var taReviewLink =
			setupLegalPopup(
				$('<a>')
				.attr({
					href: data.web_url,
				})
			);
		var taReviewImg =
			$('<img>')
			.attr({
				id: 'taReviewImg',
				alt: 'tripadvisor ratings',
				src: data.rating_image_url,
			});
		var taReviewCount =
			$('<span>')
			.attr({
				id: 'taReviewNumber',
			})
			.html(data.num_reviews + " Reviews");
		var taReviewElement =
			$('.ta-container-review')
			.append(
				taReviewLink.append(
					taReviewImg,
					taReviewCount
				)
			)
			.fadeIn()
			.css({
				visibility: 'visible',
			})
			.resize();
	}
	retrieveTripadvisorData();
</script>
<hr/>
<?php include("footer.php"); ?>
