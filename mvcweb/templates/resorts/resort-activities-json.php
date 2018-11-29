<?php

    $code = (string)$context->xpath("page//@code")[0];
    $option_code = "MVC_OSA_" . strtoupper($code);

    $activities_data = get_option($option_code);
    $activities = new SimpleXMLElement($activities_data);

    $activity_rows = $activities->xpath("//Row");

	$json = json_encode($activity_rows);
	echo $json;
?>