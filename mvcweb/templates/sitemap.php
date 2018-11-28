<div class="container general-info">
	<h1 class="general-info-title">Site Map</h1>
	<div class='sitemap'>
		<?php
			$pages = get_pages(array(
				'sort_column' => 'menu_order',
			));
			$postid = url_to_postid( 'timeshare-ownership/' );

			$GLOBALS['search_excludes'] = explode(",",get_option("MVC_SEARCH_EXCLUDE"));

			function filter_pages($page) {
				global $search_excludes;
				$isEbrochure = strpos($page->post_name, 'ebrochures') !== FALSE || strpos(get_post($page->post_parent, OBJECT)->post_name, 'ebrochures') !== FALSE || strpos(strtolower(get_post($page->post_parent, OBJECT)->post_title), 'ebrochures') !== FALSE;
				return !in_array($page->ID, $GLOBALS['search_excludes']) && $page->ID !== $postid && $page->post_title !== 'api' && emptyOrNull($page->post_title) === FALSE && !$isEbrochure;
			}

			if ($pages !== FALSE) {
				$filtered = array_filter($pages, "filter_pages");
				foreach($filtered as $url) {
					$url->post_title = checkForSpecialMarks($url->post_title);
				}
				$walker_page = new Walker_Page();
				echo '<ul>' . $walker_page->walk($filtered, 0) . '</ul>';
			}
		?>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			ul = $(".page-item-<?php echo $postid; ?>").find("ul");
			$(".page-item-<?php echo $postid; ?>").html("Timeshare Ownership");
			$(".page-item-<?php echo $postid; ?>").append(ul);
		});
	</script>
</div>
<?php echo horizontalBreak(); ?>
