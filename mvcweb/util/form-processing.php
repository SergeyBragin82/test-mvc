<?php
require_once(dirname(__DIR__) . '/templates/classes/request_info_json.php');
require_once(dirname(__DIR__) . '/templates/classes/form_json.php');

add_action( 'admin_post_nopriv_request_info_form', 'handle_request_info_form');
add_action( 'admin_post_request_info_form', 'handle_request_info_form' );
add_action( 'admin_post_activity_edit_form', 'handle_request_activity_edit_form' );


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

function handle_hertz_resort_form() {

	// check for file and replace if no longer there (aka picked up)
	$uniqueID = random_int(constant("PHP_INT_MIN"), constant("PHP_INT_MAX"));
	$fileLocation =  '/user/forms/callcenter/';
	$intLocation = $fileLocation . '/internal/';

	if(!file_exists($intLocation)) {
		mkdir($intLocation);
	}

	if(!file_exists($fileLocation)) {
		mkdir($fileLocation);
	}

	$now = date("omdH") . "0000";

	$fileName = 'formData_callcenter' . $now . '.txt';
	$fullPath = $intLocation . $fileName;

	if(!file_exists($fullPath)) {
		$file = "WEB_CD|FIRST_NAME|LAST_NAME|PHONE|EMAIL|CITY|STATE_PROV|POSTAL_CD|OPTIN|ORIGIN_LOC|FORM_LOC|SUBMIT_DT|MRW_MEMBER_CD\r\n";
	} else {
		$file = file_get_contents($fullPath);
	}

	// escape out unwanted pipes
	foreach($_POST as $key => $value) {
		$_POST[$key] = str_replace("|", "\\|", $value);
	}

	$now = date("c");

	$phone = preg_replace( '/[^0-9]/', '', $_POST['PHONE'] );

	$file .= getGUID() . "|" . $_POST["FIRST_NAME"] . "|" . $_POST["LAST_NAME"] . "|" . $phone . "|" . $_POST["EMAIL"] . "|" . $_POST["CITY"] . "|" . $_POST["STATE_PROV"] . "|" . $_POST["POSTAL_CD"] . "|" . ($_POST["OPTIN"]=="on" ? "true" : "false") . "|" . $_POST["ORIGIN_LOC"] . "|" . $_POST["FORM_LOC"] . "|" . $now . "|" .  "\r\n";

	$filec = fopen($fullPath, "w") or die('Cannot open file: ' . $fullPath);
	fwrite($filec, $file);
	fclose($filec);

	// move old files if they are there
	for($i=1;$i<=24; $i++) {
		$check_date = date_add(date_create(), date_interval_create_from_date_string("-" . $i . " hours"));
		$check_date_str = $check_date->format("omdH") . "0000";

		$check_location_relative = "formData_callcenter" . $check_date_str . ".txt";
		$check_location_old = $intLocation . $check_location_relative;
		$check_location_new = $fileLocation . $check_location_relative;

		if(file_exists($check_location_old)) {
			rename($check_location_old, $check_location_new);
		}
	}

	echo "{\"result\":\"ok\"}";
//	header("Location: /landing/cc/offers/thankyou/?loc=" . $_POST["ORIGIN_LOC"] . "&fid=" . $_POST["FORM_LOC"]);

}

add_action( 'admin_post_delete_activity', 'handle_request_activity_delete');

function handle_request_activity_delete () {
	if(!wp_get_current_user()->exists()) {
		die();
	}

	$id = $_POST["id"];
	$code = $_POST["code"];

	$resort = new SimpleXMLElement(get_option("MVC_OSA_" . strtolower($code)));
	$node=$resort->xpath('//Row[@id="'. $id .'"]');
    $node=dom_import_simplexml($node[0]);
    $parent=$node->parentNode;
    $parent->removeChild($node);
    $new_resort=simplexml_import_dom($parent->ownerDocument);
    update_option("MVC_OSA_" . strtolower($code), $new_resort->asXML());
	echo "{\"result\":\"ok\"}";
}

function handle_request_activity_edit_form () {
	if(!wp_get_current_user()->exists()) {
		die();
	}
	
	$id = $_POST["id"];
	$code = $_POST["code"];

	$resort = new SimpleXMLElement(get_option("MVC_OSA_" . strtolower($code)));
	
	if($id) {
		$activity = $resort->xpath("//Row[@id='" . $id . "']")[0];
	} else {
		$activity = $resort->addChild("Row");
	}

	
	if(!$id) {
		$id = guidv4();
		$activity->addAttribute("id", $id);

	}

	$activity->ActivityTitle = stripslashes($_POST["title"]);
	$activity->ActivityDescription = stripslashes($_POST["description"]);
	$activity->startDate = $_POST["startDate"];
	$activity->endDate = $_POST["endDate"];
	$activity->currency = $_POST["currency"];
	$activity->currencyPrice = $_POST["price"];
	$activity->frequency = $_POST["frequency"];
	$activity->dayOfWeek = $_POST["dayOfWeek"];
	$activity->reservations = ($_POST["reservations"]=="on" ? "yes" : "no");
	$activity->ActivityPhone = $_POST["phone"];

	$activity->active = ($_POST["active"]=="on" ? "yes" : "no");
	$activity->photo = ($_POST["photo_url"]);
        $activity->photo_map = ($_POST["photo_map_url"]);
        $activity->photo_map_x = ($_POST["photo_map_x"]);
        $activity->photo_map_y = ($_POST["photo_map_y"]);

	$tags = array();

	foreach($_POST as $key=>$value) {
		if(substr($key, 0, 4)==="cat_") {
			if($value=="on") {
				$tags[] = str_replace("cat_", "", $key);
			}
		}
	}
	$activity->tags = implode(" ", $tags);

	$days = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

	switch($activity->frequency) {
		case "single":
			$activity->ActivityDateString = $activity->startDate;
			break;
		case "weekly":
			$activity->ActivityDateString = "Every " . $days[intval($activity->dayOfWeek)] . " " . explode(" ", $activity->startDate)[1];
			break;
	}

	// upload image using request ID 
	$image_dir = get_home_path() . "/wp-content/images/";
	if (!file_exists($image_dir)) {
		mkdir($image_dir);	
	}
	
	$image_dir .= "cms/";
	if (!file_exists($image_dir)) {
		mkdir($image_dir);	
	}

	// get uploaded image
	 
	if(!file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
		
    } else {
    	$img_id = guidv4();

    	$tmpfile = $_FILES['photo']['name'];
    	//$filepath = $image_dir . $id . "." . pathinfo($tmpfile, PATHINFO_EXTENSION);
    	$filepath = $image_dir . $img_id . "." . pathinfo($tmpfile, PATHINFO_EXTENSION);
    	$url = $_SERVER['REQUEST_URI'];
        if(!move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
        	// failure state
        }
        $activity->photo = "/wp-content/images/cms/" . $img_id . "." . pathinfo($tmpfile, PATHINFO_EXTENSION);
    }
    
    if(!file_exists($_FILES['photo_map']['tmp_name']) || !is_uploaded_file($_FILES['photo_map']['tmp_name'])) {
		
    } else {
    	$img_map_id = guidv4();

    	$tmpfile_map = $_FILES['photo_map']['name'];
    	//$filepath = $image_dir . $id . "." . pathinfo($tmpfile, PATHINFO_EXTENSION);
    	$filepath_map = $image_dir . $img_map_id . "." . pathinfo($tmpfile_map, PATHINFO_EXTENSION);
    	$url_map = $_SERVER['REQUEST_URI'];
        if(!move_uploaded_file($_FILES['photo_map']['tmp_name'], $filepath_map)) {
        	// failure state
        }
        $activity->photo_map = "/wp-content/images/cms/" . $img_map_id . "." . pathinfo($tmpfile_map, PATHINFO_EXTENSION);
    }

	update_option("MVC_OSA_" . $code, $resort->asXML());
        
	header("Location: admin.php?page=mvc_activities_edit&code=" . $code . "&sortby=" . $_POST['sortby'] . "&dir=" . $_POST['dir']);
	//echo htmlspecialchars($activity->asXML());
}

function guidv4()
{
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
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

add_action( 'admin_post_import_all_activities', 'handle_import_all_activities' );

function handle_import_all_activities() {

    if(!file_exists($_FILES['import_file']['tmp_name']) || !is_uploaded_file($_FILES['import_file']['tmp_name'])) {
		
    } else {
    
        $import_file = simplexml_load_file($_FILES['import_file']['tmp_name']);

        foreach($import_file as $activities){
            
            $att = $activities->Row->attributes();
            $resort_code = $att['code'];
            $activity_option = "MVC_OSA_".$resort_code;

            update_option($activity_option, $activities->asXML());

        }
    }
    header("Location: admin.php?page=mvc_activities"); 
    exit();
}
add_action( 'admin_post_delete_all_activity', 'handle_request_delete_all_activity');

function handle_request_delete_all_activity () {
        if(!wp_get_current_user()->exists()) {
		die();
	}
        $resorts = new SimpleXMLElement(get_option("MVC_RESORTS_INDEX"));
        foreach ($resorts as $resort) {
                
            try{
                $resort_code = strtolower($resort->xpath("@code")[0]);
                $clear_dom = new DomDocument('1.0','utf-8'); 
                $tag_xml = $clear_dom->appendChild($clear_dom->createElement('Activities'));
                $tag_xml->appendChild($clear_dom->createElement('Activity'));
                $clear_resort = simplexml_import_dom($clear_dom);
                update_option("MVC_OSA_" . strtolower($resort_code), $clear_resort->asXML());

            }catch(Exception $e){
                // do nothing... php will ignore and continue    
            }
	}
        header("Location: admin.php?page=mvc_activities"); 
        exit();
}


?>
