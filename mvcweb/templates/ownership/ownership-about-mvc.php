<?php
	include(dirname(__DIR__) . '/partials/carousel_widget.php');
	include(dirname(__DIR__) . '/common.php');
		//$masonryItems = getMediaMasonry(6);
		$masonryItems = array(
			0 => (object)(array(
				'imgPath' => 'masonry/Layer_48.jpg',
				'imgAlt' => 'A spacious vacation villa with a fireplace and view of a snowy winter land outside. '
			)),
			1 => (object)(array(
				'imgPath' => 'masonry/Layer_50.jpg',
				'imgAlt' => 'A vacation villa bedroom and bathroom view with large tub and plenty of space to spread out. '
			)),
			2 => (object)(array(
				'imgPath' => 'masonry/Layer_49.jpg',
				'imgAlt' => 'A sample breakfast table in a vacation villa kitchen.  Refrigerator, dishwasher, oven, and microwave in the background. '
			)),
			3 => (object)(array(
				'imgPath' => 'masonry/Villa_1.jpg',
				'imgAlt' => 'A villa living room overlooking a beautiful beach view. '
			)),
			4 => (object)(array(
				'imgPath' => 'masonry/Villa_2.jpg',
				'imgAlt' => 'A villa balcony overlooking a beautiful beach with white clouds and blue sky. '
			)),
			5 => (object)(array(
				'imgPath' => 'masonry/Villa_3.jpg',
				'imgAlt' => 'View of a villa living room and kitchen. '
			))
		);
?>
<div class='ownership-about-mvc'>
	<a name='lifestyle-video'></a>
	<div class="text-center video-banner" id='video-banner-container'>
		<div class='video-banner-content'>
			<h2 class='video-banner-content-title'><br><br>Welcome to <br>Vacation Greatness</h2>
			<div class='video-banner-content-icon' style="display:none;">
				<i class='icon-play6'></i>
			</div>
		</div>
		<?php // https://s23039.pcdn.co/wp-content/images/about-mvc-video-thumbnail.jpg ?>
		<?php echo getImageTag('about-mvc-video-thumbnail.jpg', 'Image of girl riding on her father\'s shoulders on a beach. Welcome to Vacation Greatness overview video. ', array(0 => "video-thumbnail"), true); ?>
		
		<div class='video-frame' id='youtube-video'></div>
	</div>
	<div class="container home-banner">
		<div class="row justify-content-center">
			<div class="title">
				<div class="title-header">
					<h1>A Lifestyle Unlike Any Other Awaits You</h1>
				</div>
				<div class="title-description">
						With destinations as expansive as your imagination and experiences as diverse as your ever-changing needs, Marriott Vacation Club is here to help you live the vacation lifestyle.
				</div>
			</div>
		</div>
	</div>
	<?php
		echo horizontalBreak();
		echo getUnforgettableExperiences();
		echo horizontalBreak();
		echo getMarriottQuality();
		echo horizontalBreak();
	?>
	<div class="container-fluid body-content">
		<a name='villa-difference'></a>
		<h2 class="kessel-header">
			the villa vacation difference
		</h2>
		<p>
		Spread out, settle in and make yourself at home with a relaxing and restorative villa vacation. Explore villa details and amenities available at each one of our <a class='general-info-link' href='/vacation-resorts'>resorts</a>. We also offer <a class='general-info-link' href='/vacation-resorts-pulse'>properties</a> with distinctive guestrooms and suites in vibrant cities and prime locations throughout the U.S.
		</p>
		<div class="container-fluid" style="padding: 0;">
			<?php echo masonry($masonryItems, true); ?>
		</div>
	</div>
</div>

<?php echo horizontalBreak(); ?>

<script>
	var videoContainer = document.getElementById('video-banner-container');
	var videoThumbnailContent = document.getElementsByClassName('video-banner-content')[0];
	var videoThumbnail = document.getElementsByClassName('video-thumbnail')[0];
	var youtubeVideo;
	var tag = document.createElement('script');
  var player;
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	function thumbnailClicked() {
		// no op for now
		return;

		videoThumbnailContent.style.display = 'none';
		videoThumbnail.style.display = 'none';
		youtubeVideo.style.display = 'inline-block';
		if (player)
			player.playVideo();
	}

  // 3. This function creates an <iframe> (and YouTube player)
  //    after the API code downloads.
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('youtube-video', {
      height: videoContainer.offsetHeight,
      width: '100%',
      videoId: 'ZA45vZkYxRk',
			playerVars: {
				autoplay: 0,
				showinfo: 0,
				rel: 0,
			},
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
    });
  }

  // 4. The API will call this function when the video player is ready.
  function onPlayerReady(event) {
		youtubeVideo = document.getElementById('youtube-video')
		//videoContainer.onclick = thumbnailClicked;
  }

  // 5. The API calls this function when the player's state changes.
  //    The function indicates that when playing a video (state=1),
  //    the player should play for six seconds and then stop.
  function onPlayerStateChange(event) {
  }
  function stopVideo() {
		if (player)
    	player.stopVideo();
	}
</script>
