<?php
function mihertz ($page_data, $metadata) {
	$prefix = WP_PLUGIN_DIR . "/mvcweb";
 
	// load the pcm parsing file
	$parse_a = simplexml_load_file($prefix . "/data/landing/resorts.xml");


	$resorts = explode(",", $metadata->xpath("@resort")[0]);
	$filtered_page_data = new SimpleXMLElement("<mvcweb/>");
	
	foreach ($resorts as $resort) {
		sxml_append($filtered_page_data, $page_data->xpath("//Resort[code='" . $resort . "']")[0], false);
		sxml_append($filtered_page_data, $parse_a->xpath("//resort[@code='" . $resort  ."']")[0], false);
	}

	return $filtered_page_data;
}?>