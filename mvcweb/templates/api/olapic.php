<?php

// switch (json_last_error()) {
// 	case JSON_ERROR_NONE:
// 			echo ' - No errors';
// 	break;
// 	case JSON_ERROR_DEPTH:
// 			echo ' - Maximum stack depth exceeded';
// 	break;
// 	case JSON_ERROR_STATE_MISMATCH:
// 			echo ' - Underflow or the modes mismatch';
// 	break;
// 	case JSON_ERROR_CTRL_CHAR:
// 			echo ' - Unexpected control character found';
// 	break;
// 	case JSON_ERROR_SYNTAX:
// 			echo ' - Syntax error, malformed JSON';
// 	break;
// 	case JSON_ERROR_UTF8:
// 			echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
// 	break;
// 	default:
// 			echo ' - Unknown error';
// 	break;
// }
//

	function getStreamByKey($streamTagKey) {
		$olapicStreamUrl = 'https://photorankapi-a.akamaihd.net/customers/216967/streams/search?version=v2.2&auth_token=6e7d38d5c66a82548e2717a92d97523bb6c3b7c932fc75b532ea8425762c84a7&tag_key=' . $streamTagKey;
		return performGetRequest($olapicStreamUrl);
	}

	function getMediaOfStream($streamID) {
		$mediaUrl = 'https://photorankapi-a.akamaihd.net/streams/' . $streamID . '/media/recent?version=v2.2&auth_token=6e7d38d5c66a82548e2717a92d97523bb6c3b7c932fc75b532ea8425762c84a7';
		return performGetRequest($mediaUrl);
	}

	function getMediaOfCustomer() {
		$media = "https://photorankapi-a.akamaihd.net/customers/216967/media/recent?version=v2.2&auth_token=6e7d38d5c66a82548e2717a92d97523bb6c3b7c932fc75b532ea8425762c84a7";
		return performGetRequest($media);
	}

	function getMediaUrl($mediaData) {
		$masonryURLs = array();
		foreach($mediaData['_embedded']['media'] as $mediaObject) {
			array_push($masonryURLs, $mediaObject['images']);
		}
		return $masonryURLs;
	}

 ?>
