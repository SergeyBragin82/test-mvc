<?php
	function renderRequest($request) {
				
	}
?>

<h4>Content Updates Approved</h4>
<table>
<?php
	$queue = explode(",", get_option("MVC_CMS_APPROVED_QUEUE"));
	foreach($queue as $entry) {
		$request = get_option("MVC_CMS_REQUEST_" . $entry);
		$request_object = json_decode($request);

		renderRequest($request_object);
	}
?>
</table>
<h4>Content Updates Not Yet Approved</h4>
<?php
	$queue = explode(",", get_option("MVC_CMS_REQUEST_QUEUE"));
	foreach($queue as $entry) {
		$request = get_option("MVC_CMS_REQUEST_" . $entry);
		$request_object = json_decode($request);
		echo '<a href="' . $request_object->link . "?mode=approve&content_id=" . $request_object->content_id . "&request_id=" . $request_object->id . '" target="_blank">PAGE LINK</a><BR>';
		echo htmlspecialchars($request) . "<BR>";
	}
?>