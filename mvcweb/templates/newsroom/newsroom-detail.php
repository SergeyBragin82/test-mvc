<h1 class='newsroom-title'>
	Newsroom
</h1>
<div class='newsroom-content'>
	<div class='container-fluid'>
		<div class='row'>
			<div class='newsroom-article-detail'>
				<a class='newsroom-back' href='/newsroom'>
					BACK TO LIST
				</a>
				<h1 class="newsroom-article-detail-title"><?php echo $context->xpath("//title")[0]?></h1>
				<h3 class="newsroom-article-detail-date"><?php echo strtoupper($context->xpath("//date")[0]) ?></h3>
				<?php
					echo str_replace("Download High-Res Image", "", htmlspecialchars_decode($context->xpath("//page_data/.")[0]->asXML()));	
					$pdf = $context->xpath("//pdf")[0];
					if ($pdf) { 
				?>
					<a href="<?php echo $pdf; ?>">Download PDF</a>
				<?php } ?>
			</div>

		</div>
	</div>
</div>
<?php echo horizontalBreak(); ?>

<script>
	$(function() {
		if (window.location.href.indexOf('Marriotts_Bali_Nusa_Dua_Gardens_Now_Taking_Reservations')) {
			$('a').each(function(index, element) {
				if ($(element).attr('href') === 'http://www.marriott.com/hotels/travel/DSPMV-mvc-bali/?mktcmp=mvcrentalcmd') {
					$(element).attr('href', 'http://www.marriott.com/hotels/travel/dpsmv-marriotts-bali-nusa-dua-gardens/?mktcmp=mvcrentalcmd');
				}
			});
		}
	})
</script>
