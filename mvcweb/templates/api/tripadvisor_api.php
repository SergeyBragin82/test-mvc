<?php

$GLOBALS['TRIPADVISOR_API_KEY'] = get_param('TRIPADVISOR_API_KEY');

// API constants, you shouldn't have to change these.
$GLOBALS['TRIPADVISOR_API_HOST'] = "https://api.tripadvisor.com/api/partner/2.0";
$GLOBALS['TRIPADVISOR_LOCATION_PATH'] = "/location";
$GLOBALS['TRIPADVISOR_REVIEWS_PATH'] = "/location-reviews";

/**
 * Makes a request to the Yelp API and returns the response
 *
 * @param    $api_token   API token
 * @param    $host    The domain host of the API
 * @param    $path    The path of the API after the domain.
 * @param    $url_params    Array of query-string parameters.
 * @return   The JSON response from the request
 */
function request($api_token, $host, $path, $url_params = array()) {
    // Send Tripadvisor API Call
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
                "X-TripAdvisor-API-Key: " . $api_token,
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
 * Query the Business API by location_id
 *
 * @param    $api_token   API bearer token from obtain_bearer_token
 * @param    $location_id    The ID of the business to query
 * @return   The JSON response from the request
 */
function get_location($api_token, $location_id) {
    $location_path = $GLOBALS['TRIPADVISOR_LOCATION_PATH'] . "/" . urlencode($location_id);
    return request($api_token, $GLOBALS['TRIPADVISOR_API_HOST'], $location_path, array(
        'lang' => 'en_US',
        'currency' => 'USD',
        'fulltext' => 'true'
    ));
}

/**
 * Queries the API by the input values from the user
 *
 * @param    $tripadvisor_code        The business ID
 */
function query_trip_api($tripadvisor_code) {
    $api_token = $GLOBALS['TRIPADVISOR_API_KEY'];
    $response = get_location($api_token, $tripadvisor_code);
    $pretty_response = json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    echo($pretty_response);
}

$tripadvisor_code = $_GET['taCode'];

query_trip_api($tripadvisor_code);

?>
