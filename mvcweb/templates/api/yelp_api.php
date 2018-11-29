<?php

$GLOBALS['YELP_API_KEY'] = get_param('YELP_API_KEY');

// API constants, you shouldn't have to change these.
$GLOBALS['API_HOST'] = "https://api.yelp.com";
$GLOBALS['SEARCH_PATH'] = "/v3/businesses/search";
$GLOBALS['BUSINESS_PATH'] = "/v3/businesses/";  // Business ID will come after slash.
$GLOBALS['TOKEN_PATH'] = "/oauth2/token";
$GLOBALS['GRANT_TYPE'] = "client_credentials";

// Defaults for our simple example.
$GLOBALS['DEFAULT_TERM'] = "dinner";
$GLOBALS['DEFAULT_LOCATION'] = "San Francisco, CA";
$GLOBALS['SEARCH_LIMIT'] = 50;

/**
 * Makes a request to the Yelp API and returns the response
 *
 * @param    $bearer_token   API bearer token from obtain_bearer_token
 * @param    $host    The domain host of the API
 * @param    $path    The path of the API after the domain.
 * @param    $url_params    Array of query-string parameters.
 * @return   The JSON response from the request
 */
function request($bearer_token, $host, $path, $url_params = array()) {
    // Send Yelp API Call
    try {
        $curl = curl_init();
        if (FALSE === $curl)
            throw new Exception('Failed to initialize');

        $url = $host . $path . "?" . http_build_query($url_params);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,  // Capture response.
            CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $bearer_token,
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);

        if (FALSE === $response)
            throw new Exception(curl_error($curl), curl_errno($curl));
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (200 != $http_status)
            throw new Exception($response, $http_status);

        curl_close($curl);
    } catch(Exception $e) {
        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);
    }

    return $response;
}

/**
 * Query the Search API by a search term and location
 *
 * @param    $bearer_token   API bearer token from obtain_bearer_token
 * @param    $term        The search term passed to the API
 * @param    $location    The search location passed to the API
 * @return   The JSON response from the request
 */
function search($bearer_token, $term, $lat, $long) {
    $url_params = array();

    $url_params['categories'] = $term;
    $url_params['latitude'] = $lat;
    $url_params['longitude'] = $long;
    $url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];
    $url_params['sort_by'] = 'rating';
    return request($bearer_token, $GLOBALS['API_HOST'], $GLOBALS['SEARCH_PATH'], $url_params);
}

/**
 * Query the Business API by business_id
 *
 * @param    $bearer_token   API bearer token from obtain_bearer_token
 * @param    $business_id    The ID of the business to query
 * @return   The JSON response from the request
 */
function get_business($bearer_token, $business_id) {
    $business_path = $GLOBALS['BUSINESS_PATH'] . urlencode($business_id);

    return request($bearer_token, $GLOBALS['API_HOST'], $business_path);
}

/**
 * Queries the API by the input values from the user
 *
 * @param    $term        The search term to query
 * @param    $location    The location of the business to query
 */
function query_api($term, $lat, $long, $context, $activity_xml) {

    $bearer_token = $GLOBALS['YELP_API_KEY'];

    $response = search($bearer_token, $term, $lat, $long);

    $response_object = json_decode($response);

	$global_excludes = array();

	foreach($activity_xml->xpath('//global_excludes/exclude') as $globalExclude) {
		$global_excludes[] = (string)$globalExclude->xpath('@key')[0];
	}
	$activity_excludes = array();
	foreach($activity_xml->xpath("//activity[@id='" . $_GET['cat_id'] . "']/yelp/excludes/exclude") as $activityExclude) {
		$activity_excludes[] = (string)$activityExclude->xpath('@key')[0];
	};
	$all_excludes = array_merge($global_excludes, $activity_excludes);
	$return_object = [
		"businesses" => [],
	];

    foreach($response_object->businesses as $business) {
		$categories = array_map(function($category) {
			return $category->alias;
		}, $business->categories);

		if(empty(array_intersect($categories, $all_excludes))) {
			$return_object['businesses'][] = $business;
		}
	}
    
    $pretty_response = json_encode($return_object, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
   echo($pretty_response);
}

$activity_xml = new SimpleXMLElement(get_option("MVC_ACTIVITY_DATA"));

$cats = explode(',', $_GET['cat_id']);
$catkeys = array();

foreach ($cats as $cat) {
    $category_array = $activity_xml->xpath("//activity[@id='{$cat}'][1]/yelp/includes/include/@key");    

    foreach($category_array as $catkey) {
        if(!in_array($catkey, $catkeys)) {
            $catkeys[] = $catkey;
        }
    }
}


$terms = join($catkeys, ",");
$latitude = $_GET['lat'];
$longitude = $_GET['long'];

query_api($terms, $latitude, $longitude, $context, $activity_xml);

?>
