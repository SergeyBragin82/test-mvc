
<div class='inspiration'>
 <div class="container-fluid home-banner header-underline">
	 <div class="row justify-content-center">
		 <div class="title">
			 <div class="title-header">
				 <h1>Authentic Travel Tips <i>for</i> Better Vacations</h1>
			 </div>
			 <div class="title-description">
					 Looking for travel tips or ideas for your next getaway? You’ve come to the right place! Local experts and experienced travelers share insights and details about amazing destinations they’ve explored firsthand. Be sure to check in often! We’re always adding new experiences to inspire your vacation lifestyle.
			 </div>
		 </div>
	 </div>
 </div>
 <div class="container inspiration-item-collection">
		 <div class='row inspiration-item-page' id='page1'>
			<div class='col-md-6 item'>
				<?php echo inspirationBlogElement('Vacation Goals', 'Find Your Travel Inspiration', 'more', 'https://blog.marriottvacationclub.com/better-vacations-beginning-today/?cid=intrnl-mvc-blog-better-vacations', 'inspiration/first-article.jpg', 'Vacation explorer\'s desk.  Find your travel inspiration. '); ?>
			</div>
			<div class='col-md-6 item'>
					<?php echo inspirationBlogElement('Owner Tips', 'Why I Love My Vacation Club Points', 'more', 'https://blog.marriottvacationclub.com/owner-story-i-like-my-weeks-but-love-my-vacation-club-points/?cid=intrnl-mvc-blog-owner-story-weeks-points', 'inspiration/Bob_Curley.jpg', ' An Owner\'s perspective on how to use Vacation Club Points. '); ?>
			</div>
			<div class='col-md-6 item'>
					<?php echo inspirationBlogElement('Hawaii Resort', 'Sun and Fun at Waikoloa Beach', 'more', 'https://blog.marriottvacationclub.com/a-day-of-fun-waikoloa-beach-on-the-big-island/?cid=intrnl-mvc-blog-day-of-fun-waikoloa-beach', 'inspiration/Waikoloa.jpg', 'Tropical lagoon pool and hot tub in Waikoloa Beach on the Big Island. '); ?>
			</div>
			<div class='col-md-6 item'>
					<?php echo inspirationBlogElement('From A Local Expert', 'Four Days in New York City', 'more', 'https://blog.marriottvacationclub.com/from-a-local-expert-4-days-in-new-york-city/?cid=intrnl-mvc-blog-local-expert-four-days-nyc', 'inspiration/nyc.jpg', 'Local expert\'s advice for 4 days in New York City. '); ?>
			</div>
	 </div>
	 	<div class='row inspiration-item-page' id='page2'>
		 <div class='col-md-6 item'>
       <?php echo inspirationBlogElement('Insider\'s Guide', 'Go Shelling on Marco Island', 'more','https://blog.marriottvacationclub.com/insiders-guide-shelling-floridas-marco-island/?cid=intrnl-mvc-blog-insiders-guide-shelling', 'inspiration/Marco_Island.jpg', 'Look for sea shells on the beach in Marco Island. '); ?>
		 </div>
		 <div class='col-md-6 item'>
        <?php echo inspirationBlogElement('Food & Drink', 'Sip and Sightsee on the Napa Wine Train', 'more', 'https://blog.marriottvacationclub.com/napa-wine-train-vintage-ride-vineyards/?cid=intrnl-mvc-blog-napa-wine-train', 'inspiration/Napa_Wine_Train.jpg', 'Sip wine and sightsee on the Napa Wine Train. '); ?>
		 </div>
		 <div class='col-md-6 item'>
        <?php echo inspirationBlogElement('Travel Hacks', 'Packing Tips from Expert Cruisers', 'more', 'https://blog.marriottvacationclub.com/5-tips-enjoying-first-cruise/?cid=intrnl-mvc-blog-five-tips-first-cruise', 'inspiration/Cruise.jpg', 'Cruiseship deck chair enjoying a sunrise alone. Packing tips from expert cruisers. '); ?>
		 </div>
		 <div class='col-md-6 item'>
        <?php echo inspirationBlogElement('Off the Beaten Path', '4 Things to Do in Park City', 'more', 'https://blog.marriottvacationclub.com/park-city-for-non-skiers-4-ideas-for-winter-fun/?cid=intrnl-mvc-blog-park-city-non-skiers', 'inspiration/Park_City.jpg', 'Sled dogs resting. Four things to do in Park City besides skiing. '); ?>
		 </div>
	 </div>
 </div>

 <div class='container-fluid share' id='inspirationCollection' style='background-image: url(<?php echo $GLOBALS['img_path'] . 'iStock-612754404.jpg';?>);'>
	 <div class='share-content text-center'>
		 <h3 class='title'>
			 Share Your Vacation
		 </h3>
		 <div class="social-icons">
			 <a href="https://www.facebook.com/MarriottVacationClub" target="_blank">
				 <i class="icofont icofont-social-facebook"></i>
			 </a>
			 <a href="https://www.pinterest.com/marriottvacclub/" target="_blank">
				 <i class="icofont icofont-social-pinterest"></i>
			 </a>
			 <a href="https://www.instagram.com/marriottvacationclub/" target="_blank">
				<i class="icofont icofont-social-instagram"></i>
			</a>
		 </div>
	 </div>
 </div>

<?php echo vacationGreatnessIntro(); ?>
 <div class="container-fluid" style="background-color: #f5f5f5; padding: 2rem 4rem 4rem 4rem;">
 	<div id="olapic_specific_widget"></div><script type="text/javascript" src="https://photorankstatics-a.akamaihd.net/81b03e40475846d5883661ff57b34ece/static/frontend/latest/build.min.js"  data-olapic="olapic_specific_widget" data-instance="528aafe46ecb746f50b5310b0463018a" data-apikey="6e7d38d5c66a82548e2717a92d97523bb6c3b7c932fc75b532ea8425762c84a7" async="async"></script>
 </div>
</div>

<script>
	$('#inspirationCollection').twbsPagination({
			totalPages: 2,
			onPageClick: function (event, page) {
				$('.inspiration-item-page').hide();
				$('#page' +	page).fadeIn();
			},
			next: '',
			prev: '',
			first: '',
			last: '',
			pageClass: 'marriott-page-item',
			anchorClass: '',
	});
</script>
