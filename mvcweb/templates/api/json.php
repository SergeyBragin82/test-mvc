<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once(dirname(__DIR__) . '/classes/request_info_json.php');
	require_once(dirname(__DIR__) . '/classes/form_json.php');
	require_once(dirname(dirname(__DIR__)) . '/util/phpmailer/Exception.php');
	require_once(dirname(dirname(__DIR__)) . '/util/phpmailer/PHPMailer.php');

	// Submit form
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

	function generateJsonInfo($jsonInfo) {
		//write_log(json_encode($jsonInfo));
		
		$toSave = new FormJson(array(
			"prefix" => $jsonInfo->prefix,
			"firstName" => $jsonInfo->firstName,
			"lastName" => $jsonInfo->lastName,
			"addressCountryCode" => $jsonInfo->addressCountryCode,
			"addressPostalCode" => $jsonInfo->addressPostalCode,
			"daytimeTelephoneNumber" => $jsonInfo->phone1,
			"emailAddress" => $jsonInfo->email,
			"messageTemplateID" => intval($jsonInfo->messageTemplateId),
			"messageTypeID" => intval($jsonInfo->messageTypeId),
			"messageStatusID" => intval($jsonInfo->messageStatusId),
			"workQueueID" => intval($jsonInfo->workQueueId),
			"data" => $jsonInfo->webCrmContent,
			"addressLine1" => $jsonInfo->address1,
			"addressLine2" => $jsonInfo->address2,
			"addressCity" => $jsonInfo->city,
			"addressStateProvince" => $jsonInfo->stateProvince,
			"addressPostalCode" => $jsonInfo->zipcode,
		));
		//echo json_encode($toSave);
		echo "{\"callFailed\":false}";
		write_log(json_encode($toSave));
		saveToFile($toSave);
	}

	$json = json_decode(file_get_contents('php://input'));

	//{"params":[],"method":"MVCFormsService.getTimeslotsAvailInit","id":1}
	if($json->method=="MVCFormsService.getTimeslotsAvailInit") {
		?>{"result":{"errorMsg":null,"javaClass":"com.mvc.services.json.dto.FiveDayListTO","callFailed":false,"nextFiveDays":{"list":[{"javaClass":"com.mvc.services.json.dto.TimeslotsTO","timeslots":{"list":[{"dayOfWeek":"2","timeOfDay":"10:00 AM EST","slotId":"MON1000","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"2","timeOfDay":"11:30 AM EST","slotId":"MON1130","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"2","timeOfDay":"01:30 PM EST","slotId":"MON1330","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"2","timeOfDay":"03:30 PM EST","slotId":"MON1530","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"2","timeOfDay":"04:30 PM EST","slotId":"MON1630","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"2","timeOfDay":"07:00 PM EST","slotId":"MON1900","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"2","timeOfDay":"07:30 PM EST","slotId":"MON1930","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"}],"javaClass":"java.util.ArrayList"},"calendarDay":"2018-04-23","displayedDay":"Mon, Apr 23"},{"javaClass":"com.mvc.services.json.dto.TimeslotsTO","timeslots":{"list":[{"dayOfWeek":"3","timeOfDay":"10:00 AM EST","slotId":"TUE1000","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"3","timeOfDay":"11:30 AM EST","slotId":"TUE1130","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"3","timeOfDay":"01:30 PM EST","slotId":"TUE1330","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"3","timeOfDay":"03:30 PM EST","slotId":"TUE1530","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"3","timeOfDay":"04:30 PM EST","slotId":"TUE1630","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"3","timeOfDay":"07:00 PM EST","slotId":"TUE1900","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"3","timeOfDay":"07:30 PM EST","slotId":"TUE1930","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"}],"javaClass":"java.util.ArrayList"},"calendarDay":"2018-04-24","displayedDay":"Tue, Apr 24"},{"javaClass":"com.mvc.services.json.dto.TimeslotsTO","timeslots":{"list":[{"dayOfWeek":"4","timeOfDay":"10:00 AM EST","slotId":"WED1000","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"4","timeOfDay":"11:30 AM EST","slotId":"WED1130","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"4","timeOfDay":"01:30 PM EST","slotId":"WED1330","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"4","timeOfDay":"03:30 PM EST","slotId":"WED1530","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"4","timeOfDay":"04:30 PM EST","slotId":"WED1630","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"4","timeOfDay":"07:00 PM EST","slotId":"WED1900","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"4","timeOfDay":"07:30 PM EST","slotId":"WED1930","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"}],"javaClass":"java.util.ArrayList"},"calendarDay":"2018-04-25","displayedDay":"Wed, Apr 25"},{"javaClass":"com.mvc.services.json.dto.TimeslotsTO","timeslots":{"list":[{"dayOfWeek":"5","timeOfDay":"10:00 AM EST","slotId":"THU1000","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"5","timeOfDay":"11:30 AM EST","slotId":"THU1130","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"5","timeOfDay":"01:30 PM EST","slotId":"THU1330","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"5","timeOfDay":"03:30 PM EST","slotId":"THU1530","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"5","timeOfDay":"04:30 PM EST","slotId":"THU1630","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"5","timeOfDay":"07:00 PM EST","slotId":"THU1900","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"5","timeOfDay":"07:30 PM EST","slotId":"THU1930","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"}],"javaClass":"java.util.ArrayList"},"calendarDay":"2018-04-26","displayedDay":"Thu, Apr 26"},{"javaClass":"com.mvc.services.json.dto.TimeslotsTO","timeslots":{"list":[{"dayOfWeek":"6","timeOfDay":"11:30 AM EST","slotId":"FRI1130","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"6","timeOfDay":"01:30 PM EST","slotId":"FRI1330","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"},{"dayOfWeek":"6","timeOfDay":"03:30 PM EST","slotId":"FRI1530","javaClass":"com.mvc.services.json.dto.TimeslotTO","isCustomFlag":"0"}],"javaClass":"java.util.ArrayList"},"calendarDay":"2018-04-27","displayedDay":"Fri, Apr 27"}],"javaClass":"java.util.ArrayList"},"debugException":null},"id":1}<?php
	} else if ($json->method=="MVCFormsService.submitMVCFormV2") {
		
		// This whole endpoint is going away soon, so I'm just copying from form-processing.php for now rather than doing a complete refactor
		if(isset($_POST)) {
			generateJsonInfo(json_decode($json->params[0]));
			//echo json_encode(json_decode($json->params[0]));
		}
	}
?>