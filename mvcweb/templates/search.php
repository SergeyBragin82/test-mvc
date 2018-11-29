<?php
	echo horizontalBreak();
?>
	<div class="container general-info">
		<?php
global $query_string;

$post_per_page = 10;

if ($_GET['pagination']) {
	$page = (int)$_GET['pagination'];
} else {
	$page = 1;
}
$args = array(
	'post_type' => 'page',
	's' => get_query_var('keyword',''),
	'posts_per_page' => $post_per_page,
	'paged' => $page
);

$search = new WP_Query( $args );

// The Loop
if ( $args["s"] != '' && $search->have_posts() ) {

	$first_post = 1 + (($page-1) * $post_per_page);
	$last_post = $first_post + ($post_per_page-1);

	if ($last_post>$search->found_posts) {
		$last_post = $search->found_posts;
	}
	?>
			<h1 class="general-info-title">Search Results:
				<?php 
				echo htmlspecialchars(urldecode(stripslashes((string)$args["s"])), ENT_QUOTES, 'UTF-8'); 
				?>
				
			</h1>
			<div class="general-info-header mb-5">
				Showing Results:
				<?php echo $first_post; ?>-
				<?php echo $last_post; ?> of
				<?php echo $search->found_posts; ?>
			</div>
			<?php
	
	while ( $search->have_posts() ) {
	$search->the_post();

			echo '<div class="search-result">';
			echo '<h5><a class="general-info-link" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>';
			if(get_the_excerpt()!="&nbsp;")
				the_excerpt();
			
			echo '<div><a class="general-info-link" href="' . get_the_permalink() . '">' . get_the_permalink() . '</a></div>';
			echo '</div>';
	}

	wp_reset_postdata();

	?>
				<div class='search-result-pagination' id='searchResultsPagination'></div>
				<?php
} else {
	?>
					<h1 class="general-info-title">No Results</h1>
					<p class="general-info-header">Apologies, but the search returned no results.</p>
					<?php
}
?>
	</div>
	<?php echo horizontalBreak(); ?>
	<script>
		var searchCount = parseInt(<?php echo json_encode((string)$search->found_posts); ?>);
		var itemsPerPage = parseInt(<?php echo json_encode($post_per_page); ?>, 10);
		var totalPages = Math.floor(((searchCount - 1) / itemsPerPage)) + 1;
		if (totalPages == 0) {
			totalPages = 1;
		}
		var startPageParsed = parseInt(<?php echo json_encode($page); ?>, 10);
		function replaceUrlParam(url, paramName, paramValue) {
			if (paramValue == null)
				paramValue = '';
			var pattern = new RegExp('\\b(' + paramName + '=).*?(&|$)')
			if (url.search(pattern) >= 0) {
				return url.replace(pattern, '$1' + paramValue + '$2');
			}
			return url + (url.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue
		}
		$('#searchResultsPagination').twbsPagination({
			totalPages: totalPages,
			visiblePages: 5,
			startPage: startPageParsed ,
			loop: false,
			hideOnlyOnePage: true,
			initiateStartPageClick: false,
			pageVariable: 'pagination',
			pageClass: 'marriott-page-item',
			firstClass: 'marriott-page-item',
			lastClass: 'marriott-page-item',
			nextClass: 'marriott-page-item',
			prevClass: 'marriott-page-item',
			anchorClass: '',
			onPageClick: function (evt, page) {
				if (totalPages > 1) {
					window.location.href = replaceUrlParam(window.location.href, 'pagination', page);
				}
			}
		});
	</script>
