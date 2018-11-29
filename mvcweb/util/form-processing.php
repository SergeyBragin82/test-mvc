<?php
require_once(dirname(__DIR__) . '/templates/classes/request_info_json.php');
require_once(dirname(__DIR__) . '/templates/classes/form_json.php');

add_action( 'admin_post_nopriv_request_info_form', 'handle_request_info_form');
add_action( 'admin_post_request_info_form', 'handle_request_info_form' );

function handle_request_info_form() {
	function generateWebCrmContent($postInfo) {
		$crmContent = "<TABLE><TR><TD COLSPAN='2'>".$postInfo->formTitle."</TD></TR><TR><TD><STRONG>I would like to be contacted about :</STRONG></TD><TD>".$postInfo->ownerSelection."</TD></TR><TR><TD><STRONG>Prefix :</STRONG></TD><TD>".$postInfo->prefix."</TD></TR><TR><TD><STRONG>First Name :</STRONG></TD><TD>". $postInfo->firstName."</TD></TR><TR><TD><STRONG>Last Name :</STRONG></TD><TD>".$postInfo->lastName."</TD></TR><TR><TD><STRONG>Country :</STRONG></TD><TD>".$postInfo->addressCountryCode."</TD></TR><TR><TD><STRONG>Address Line 1 :</STRONG></TD><TD>".$postInfo->addressLine1."</TD></TR><TR><TD><STRONG>City :</STRONG></TD><TD>".$postInfo->addressCity."</TD></TR><TR><TD><STRONG>State/Province :</STRONG></TD><TD>".$postInfo->addressStateProvince."</TD></TR><TR><TD><STRONG>Zip Code :</STRONG></TD><TD>".$postInfo->addressPostalCode."</TD></TR><TR><TD><STRONG>Phone :</STRONG></TD><TD>".$postInfo->daytimeTelephoneNumber."</TD></TR><TR><TD><STRONG>Email :</STRONG></TD><TD>".$postInfo->emailAddress."</TD></TR><TR><TD><STRONG>Email Opt-in :</STRONG></TD><TD>".$postInfo->optIn."</TD></TR><TR><TD><STRONG>Phone Opt-in :</STRONG></TD><TD>".$postInfo->optIn."</TD></TR><TR><TD><STRONG>Mail Opt-in :</STRONG></TD><TD>".$postInfo->optIn."</TD></TR><TR><TD><STRONG>LOC :</STRONG></TD><TD>".$postInfo->originLOC."</TD></TR><TR><TD><STRONG>Form Id :</STRONG></TD><TD>".$postInfo->formId."</TD></TR><TR><TD><STRONG>Form URL :</STRONG></TD><TD>".$postInfo->formUrl."</TD></TR><TR><TD><STRONG>Referring URL :</STRONG></TD><TD>".$postInfo->referringURL."</TD></TR></TABLE>";
			return $crmContent;
	}

	function writeToFile($fileLocation, $content) {
		$file = fopen($fileLocation, "w") or die('Cannot open file: ' . $fileLocation);
		fwrite($file, $content);
		fclose($file);
	}
	function saveToFile($object) {
		$uniqueID = random_int(constant("PHP_INT_MIN"), constant("PHP_INT_MAX"));
		$fileLocation =  '/user/forms/';
		$fileName = 'formData' . $uniqueID . '.json';
		$fullPath = $fileLocation . $fileName;
		clearstatcache();
		if(!file_exists($fileLocation)) {
			mkdir($fileLocation);
		}
		if (file_exists($fullPath)) {
			$fileContent = file_get_contents($fullPath);
			$jsonObject = json_decode($fileContent);
			$jsonObject[] = $object;
			writeToFile($fullPath, json_encode($jsonObject));

		} else {
			writeToFile($fullPath,json_encode($object));

		}
	}

	function generateJsonInfo() {
		$jsonInfo = new RequestInfo($_POST);
		write_log(json_encode($jsonInfo));
		$table = generateWebCrmContent($jsonInfo);
		$jsonInfo->webCrmContent = $table;
		$toSave = new FormJson(array(
			"firstName" => $jsonInfo->firstName,
			"lastName" => $jsonInfo->lastName,
			"addressCountryCode" => $jsonInfo->addressCountryCode,
			"addressPostalCode" => $jsonInfo->addressPostalCode,
			"daytimeTelephoneNumber" => $jsonInfo->daytimeTelephoneNumber,
			"emailAddress" => $jsonInfo->emailAddress,
			"messageTemplateID" => intval($jsonInfo->messageTemplateID),
			"messageTypeID" => intval($jsonInfo->messageTypeID),
			"messageStatusID" => intval($jsonInfo->messageStatusID),
			"workQueueID" => intval($jsonInfo->workQueueID),
			"addressCity" => $jsonInfo->addressCity,
			"addressStateProvince" => $jsonInfo->addressStateProvince,
			"data" => $jsonInfo->webCrmContent,
		));
		write_log(json_encode($toSave));
		saveToFile($toSave);
	}
	if(isset($_POST)) {
		generateJsonInfo();
	}
}

// Hawaiian Air form
// https://www.marriottvacationclub.com/landing/hawaiian-airlines/
add_action( 'admin_post_nopriv_hawaiian_air_form', 'handle_hawaiian_air_form');
add_action( 'admin_post_hawaiian_air_form', 'handle_hawaiian_air_form' );

function handle_hawaiian_air_form() {
	function generateWebCrmContent($postInfo) {
		$crmContent = "<TABLE><TR><TD COLSPAN='2'>MVC Hawaiian Airlines Form</TD></TR><TR><TD><STRONG>Hawaiian Airlines Number:</STRONG></TD><TD>".$postInfo->haNumber."</TD></TR><TR><TD><STRONG>Prefix :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>First Name :</STRONG></TD><TD>". $postInfo->firstName."</TD></TR><TR><TD><STRONG>Last Name :</STRONG></TD><TD>".$postInfo->lastName."</TD></TR><TR><TD></TD><TD></TD></TR><TR><TD><STRONG>Address Line 1 :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>City :</STRONG></TD><TD>".$postInfo->addressCity."</TD></TR><TR><TD><STRONG>State/Province :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>Zip Code :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>Phone :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>Email :</STRONG></TD><TD>".$postInfo->emailAddress."</TD></TR><TR><TD><STRONG>Email Opt-in :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>Phone Opt-in :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>Mail Opt-in :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>LOC :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>Form Id :</STRONG></TD><TD>".$postInfo->formId."</TD></TR><TR><TD><STRONG>Form URL :</STRONG></TD><TD>".$postInfo->formUrl."</TD></TR><TR><TD><STRONG>Referring URL :</STRONG></TD><TD>".$postInfo->referringURL."</TD></TR><TR><TD><STRONG>Hawaiian Airlines Number :</STRONG></TD><TD>".$postInfo->haNumber."</TD></TR><TR><TD><STRONG>Income Level :</STRONG></TD><TD>".$postInfo->haIncome."</TD></TR></TABLE>";
			return $crmContent;
	}

	function writeToFile($fileLocation, $content) {
		$file = fopen($fileLocation, "w") or die('Cannot open file: ' . $fileLocation);
		fwrite($file, $content);
		fclose($file);
	}
	function saveToFile($object) {
		$uniqueID = random_int(constant("PHP_INT_MIN"), constant("PHP_INT_MAX"));
		$fileLocation =  '/user/forms/';
		$fileName = 'formData' . $uniqueID . '.json';
		$fullPath = $fileLocation . $fileName;
		clearstatcache();
		if(!file_exists($fileLocation)) {
			mkdir($fileLocation);
		}
		if (file_exists($fullPath)) {
			$fileContent = file_get_contents($fullPath);
			$jsonObject = json_decode($fileContent);
			$jsonObject[] = $object;
			writeToFile($fullPath, json_encode($jsonObject));

		} else {
			writeToFile($fullPath,json_encode($object));

		}
	}

	function generateJsonInfo() {
		$jsonInfo = new RequestInfo($_POST);
		write_log(json_encode($jsonInfo));
		$table = generateWebCrmContent($jsonInfo);
		$jsonInfo->webCrmContent = $table;
		$toSave = new FormJson(array(
			"firstName" => $jsonInfo->firstName,
			"lastName" => $jsonInfo->lastName,
			"emailAddress" => $jsonInfo->emailAddress,
			"messageTemplateID" => intval($jsonInfo->messageTemplateID),
			"messageTypeID" => intval($jsonInfo->messageTypeID),
			"messageStatusID" => intval($jsonInfo->messageStatusID),
			"workQueueID" => intval($jsonInfo->workQueueID),
			"data" => $jsonInfo->webCrmContent,
		));
		write_log(json_encode($toSave));
		saveToFile($toSave);
	}
	if(isset($_POST)) {
		generateJsonInfo();
	}
}

// MI Hertz Form
// https://www.marriottvacationclub.com/landing/hertz-resort/
add_action( 'admin_post_nopriv_hertz_resort_form', 'handle_hertz_resort_form');
add_action( 'admin_post_hertz_resort_form', 'handle_hertz_resort_form' );

add_action( 'admin_post_nopriv_handle_force_write', 'handle_hertz_force_write');
add_action( 'admin_post_handle_force_write', 'handle_hertz_force_write');

function handle_hertz_resort_form () {

	// escape out unwanted pipes
	foreach($_POST as $key => $value) {
		$_POST[$key] = str_replace("|", "\\|", $value);
	}

	$now = date("omdH") . "0000";

	$now_ts = date("c");

	$phone = preg_replace( '/[^0-9]/', '', $_POST['PHONE'] );
	$data = getGUID() . "|" . $_POST["FIRST_NAME"] . "|" . $_POST["LAST_NAME"] . "|" . $phone . "|" . $_POST["EMAIL"] . "|" . $_POST["CITY"] . "|" . $_POST["STATE_PROV"] . "|" . $_POST["POSTAL_CD"] . "|" . ($_POST["OPTIN"]=="on" ? "true" : "false") . "|" . $_POST["ORIGIN_LOC"] . "|" . $_POST["FORM_LOC"] . "|" . $now_ts . "|" .  "\r\n";

	$count = get_option("mi_current_count");
	if(!$count) {
		$count = 0;
	}

	$count++;
	update_option("mi_current_count", $count);
	update_option("mi_current_queue_" . $count, $data);
}

function handle_hertz_force_write() {
		$now = date("omdH") . "0000";
		error_log("Force Write: $now = " . $now);
		handle_hertz_resort_form_batch("_debug", $now, true);
		echo "{\"result\":\"ok\"}";	
}

function handle_hertz_resort_form_batch($now, $new_timestamp, $donotreset=false) {
	$data = "WEB_CD|FIRST_NAME|LAST_NAME|PHONE|EMAIL|CITY|STATE_PROV|POSTAL_CD|OPTIN|ORIGIN_LOC|FORM_LOC|SUBMIT_DT|MRW_MEMBER_CD\r\n";

	// check for file and replace if no longer there (aka picked up)
	$uniqueID = random_int(constant("PHP_INT_MIN"), constant("PHP_INT_MAX"));
	$fileLocation =  '/user/forms/callcenter/';

	if(!file_exists($fileLocation)) {
		error_log("file_exists false, creating: " . $fileLocation);
		mkdir($fileLocation);
	} else {
		error_log("file_exists true: " . $fileLocation);
	}

	$fileName = 'formData_callcenter' . $now . '.txt';
	$fullPath = $fileLocation . $fileName;

	error_log("Opening " . $fullPath . " for write");
	$filec = fopen($fullPath, "w");
	if(!$filec) {
		error_log("FAILURE: could not open " . $fullPath);
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		die('Cannot open file: ' . $fullPath);	
		return;
	} 

	if(!fwrite($filec, $data)) {
		error_log("FAILURE: could not write to " . $fullPath);
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		die('Cannot open file: ' . $fullPath);		
		return;
	}

	$currentcount = get_option("mi_current_count");
	error_log("Writing " . $currentcount . " rows");
	for($i=1; $i<=$currentcount; $i++) {
		$row = get_option("mi_current_queue_" . $i);
		if(!fwrite($filec, $row)) {
			error_log("FAILURE: could not write ROW " . $i . " to " . $fullPath);
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			die('Cannot write file: ' . $fullPath);			
			return;
		} 
	}

	$newcount = get_option("mi_current_count");
	if($newcount!=$currentcount) {
		trigger_error("Mismatch since writing the batch file: " . $newcount . " from " . $currentcount . " diff: " . ($newcount-$currentcount), E_USER_NOTICE);
	}

	if(!fclose($filec)) {
		error("FAILURE: Could not close file.");
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		die('Cannot close file: ' . $fullPath);	
		return;
	}

	if(!$donotreset) {
		update_option("mi_current_timestamp", $new_timestamp);
		error_log("Resetting timestamp to " . $new_timestamp);
		error_log("Resetting count to 0");
		update_option("mi_current_count", 0);
	}
}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}
?>
