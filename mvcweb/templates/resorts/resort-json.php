<?php
	$xml = simplexml_load_string($context->asXML());
	$json = json_encode($xml);
	echo $json;
?>