<h1 class='newsroom-title'>
	Newsroom
</h1>
<div class='newsroom-content'>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-md-8 newsroom-article-container'>
				<?php
					$articles = new SimpleXMLElement($context->xpath("//page_data")[0]);
					foreach($articles->xpath("//static_page[@permalink!='newsroom']") as $article) {
						?>
					<div class='newsroom-article'>
						<h3 class='newsroom-article-title'>
							<a href="/<?php echo $article->xpath(" permalink ")[0];?>" target="_blank">
								<?php echo $article->xpath("title")[0]; ?>
							</a>
						</h3>
						<a class="newsroom-article-date" href="/<?php echo $article->xpath(" permalink ")[0];?>" target="_blank">
							<?php echo $article->xpath("date")[0]; ?>
						</a>
						<div class="newsroom-article-description">
							<?php
										$excerpt = (string)$article->xpath("excerpt")[0];
										if(strlen($excerpt) < 200) {
											echo $excerpt;
										} else {
											if($excerpt[200] === '.') {
												echo substr($excerpt, 0, 200); 
											} else {
												$nextSpaceIndex = strpos($excerpt, '.', 200);
												echo substr($excerpt, 0, $nextSpaceIndex + 1);
											}
										}
									?>
						</div>
						<a class="newsroom-article-link" target="_blank" href="/<?php echo $article->xpath(" permalink ")[0];?>">Read more...</a>
						<div class="newsroom-article-pdf-download">
							<a class="newsroom-article-link" target="_blank" href="<?php echo $article->xpath(" pdf ")[0];?>">
								<img src="<?php echo $GLOBALS['img_path'] . 'adobe-pdf-icon.svg' ;?>" width="35" height="35" />Download PDF</a>
						</div>
					</div>
					<?php echo horizontalBreak(); 
					}
				?>
			</div>
			<div class='col-md-4 newsroom-contacts'>
				<div class='newsroom-contacts-item'>
					<div class="newsroom-contacts-item">
						<h3 class='general-info-header'>
							media contacts
						</h3>
						<div class="newsroom-contacts-item-content">
							<p>Ed Kinney / Nick Gollattscheck Marriott Vacation Club
								<br> Phone:
								<?php echo phoneNumberTemplate("1-407-206-6278", "(407)206-6278");?> /
								<?php echo phoneNumberTemplate("1-407-513-6969", "(407)513-6969"); ?>
								<br> Email:
								<a class='general-info-link' href="mailto:ed.kinney@vacationclub.com">ed.kinney@vacationclub.com</a>
								<br> Email:
								<a class='general-info-link' href='mailto:nick.gollattscheck@vacationclub.com'>nick.gollattscheck@vacationclub.com</a>
							</p>
						</div>
					</div>
					<?php echo horizontalBreak(); ?>
					<div class="newsroom-contacts-item">
						<h3 class='general-info-header'>
							media kit
						</h3>
						<div class="newsroom-contacts-item-content">
							<div>
								<i class='icon-file-pdf'></i>
								<a class='newsroom-media-link' target="_blank" href="http://www.marriottvacationclub.com/common/cms/mvc/pdfs/news/fact-sheet.pdf">Brand Fact Sheet </a>
								<div>
									<i class='icon-file-pdf'></i>
									<a class='newsroom-media-link' target="_blank" href="http://www.marriottvacationclub.com/common/cms/mvc/pdfs/news/MVC_Resort_Destination_List.pdf">Resort Destinations List </a>
								</div>
								<!--
								<div>
									<i class='icon-file-pdf'></i>
									<a class='newsroom-media-link' target="_blank" href="http://www.marriottvacationclub.com/common/cms/mvc/pdfs/news/101290_29_VillaExpGuidePR_Final.pdf">Villa Experience Guide</a>
								</div>
								-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo horizontalBreak(); ?>
