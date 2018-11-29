<?php
	$user = wp_get_current_user();

	if($user->ID==0) {
		no_access();
		die();
	}

	if ( in_array( 'author', (array) $user->roles ) ) {
	    $can_edit = true;
	}

	if (is_super_admin() || in_array( 'editor', (array) $user->roles ) ) {
		$can_edit = true;
	    $can_approve = true;
	}

	$gaction = $_GET["action"];
	switch($gaction) {
		case "reset":
			if(is_super_admin()) {
				$request_queue = explode(",", get_option("MVC_CMS_REQUEST_QUEUE"));
				foreach ($request_queue as $request) {
					delete_option("MVC_CMS_REQUEST_" . $request);
				}
				delete_option("MVC_CMS_REQUEST_QUEUE");
				echo "DONE<BR><BR>";
			}
		case "debug":
			echo "DEBUG:<BR><BR>";
			echo "Queue: " . get_option("MVC_CMS_REQUEST_QUEUE") . "<BR><BR>";
			$queue = explode(",", get_option("MVC_CMS_REQUEST_QUEUE"));
			foreach($queue as $entry) {
				if($entry!="") {
					$request = get_option("MVC_CMS_REQUEST_" . $entry);
					$request_object = json_decode($request);
					echo '<a href="' . $request_object->link . "?mode=approve&content_id=" . $request_object->content_id . "&request_id=" . $request_object->id . '" target="_blank">PAGE LINK</a><BR>';
					echo htmlspecialchars($request) . "<BR>";
				}
			}
		break;
	}

	$action = $_POST["cms_action"];
	switch($action) {

		case "update":

			if($can_edit) {
				$request = createRequest();
				echo submitRequest($request);
			} else {
				no_access();
			}
		break;
		
		case "approve":
			if($can_approve) {
				approveRequest();
			} else {
				no_access();
			}
		break;

		case "reject":
			if($can_approve) {
				rejectRequest();
			} else {
				no_access();
			}
		break;

		case "comment":
			if($can_edit||$can_approve) {
				commentRequest();
			} else {
				no_access();
			}
	}

	function cmsLog($userName, $userEmail, $message, $requestId, $contentId) {

	}

	function createRequest() {
		$user = wp_get_current_user();

		$request = array(
			"requester_id" => $user->ID,
			"requester_name" => $user->first_name . " " . $user->last_name,
			"requester_email" => $user->user_email,
			"id" => getGUID(),
			"content_id" => $_POST["content_id"],
			"content_update" => $_POST["new_content"],
			"content_existing" => $_POST["existing_content"],
			"content_preview" => "",
			"page_id" => $_POST["pid"],
			"approvers" => [],
			"link" => $_POST["link"],
			"comments" => [],
			"media" => $_POST["media"]
		);

		// Add available approvers
		$approvers = get_users(array('role' => 'editor'));

		foreach($approvers as $approver) {
			$approver_entry = array(
				"approver_id" => $approver->ID,
				"approver_name" => $approver->display_name,
				"approver_email" => $approver->user_email
			);

			$request["approvers"][] = $approver_entry;
		}

		if($_POST["media"]=="image") {

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
			 
			if ( 0 < $_FILES['file']['error'] ) {
		        no_access();
		    }
		    else {
		    	$tmpfile = $_FILES['file']['name'];
		    	$filepath = $image_dir . $request["id"] . "." . pathinfo($tmpfile, PATHINFO_EXTENSION);
		    	$url = $request["link"];
		    	$baseurl = parse_url($url, PHP_URL_SCHEME) . "://". parse_url($url, PHP_URL_HOST);
				$request["media_path"] = $baseurl . "/wp-content/images/cms/" . $request["id"] . "." . pathinfo($tmpfile, PATHINFO_EXTENSION);

		        move_uploaded_file($_FILES['file']['tmp_name'], $filepath);
		    }
		}
		return $request;
	}

	function submitRequest($request) {
		// record request
		$request_id = "MVC_CMS_REQUEST_" . $request["id"];
		$request_json = json_encode($request);
		update_option($request_id, $request_json);

		// update request queue
		$request_queue = explode(",", get_option("MVC_CMS_REQUEST_QUEUE"));
		$request_queue[] = $request["id"];
		update_option("MVC_CMS_REQUEST_QUEUE", implode(",", $request_queue));

		$recipients = array();
		foreach ($request["approvers"] as $approver) {
			$recipients[] = $approver["approver_email"];
		}

		if ($request["media_path"]) {
			$request["content_preview"] = "<img height='300' src='" . $request["media_path"] . "'/><br/><br/>";
		} 

		cms_mail($recipients, "CMS Update Request " . $request["id"], "cms_request_update", $request);

		return $request_json;
	}

	function cms_mail($tos, $subject, $template, $data) {
		
		$path = __DIR__ . "/../emails/" . $template . ".html";
		

		$body = file_get_contents($path);

		foreach ($data as $key => $value) {
			$body = str_replace("{{" . $key . "}}", $value, $body);
		}

		// email approvers
		foreach ($tos as $recipient) {
			mail($recipient, $subject, $body, "From: noreply@marriottvacationclub.com\r\nContent-type:text/html;charset=UTF-8\r\n");
		}
	}

	function approveRequest() {
		$request_id = "MVC_CMS_REQUEST_" . $_POST["request_id"];
		$request = json_decode(get_option($request_id));

		// git pull


		// update mvcstrings.xml
		$prefix = "..";
		if (!($cli==true)) {
			$prefix = WP_PLUGIN_DIR . "/mvcweb";
		}
	 
		// load the pcm parsing file
		$filepath = $prefix . "/data/cms/mvcstrings.xml";
		$strings = simplexml_load_file($filepath);
		$string_node = $strings->xpath("//string[@id='" . $request->content_id . "']")[0];
		$string_node[0] = $_POST["new_content"];

		if($request->media=="image") {
			$string_node->attributes()->url = $request->media_path;
		}

		// TODO save to repository *and* plugin destination
		file_put_contents($filepath, $strings->asXML());

		// update request queue
		$request_queue = explode(",", get_option("MVC_CMS_REQUEST_QUEUE"));
		if (($key = array_search($request->id, $request_queue)) !== false) {
   			 unset($request_queue[$key]);
		}

		update_option("MVC_CMS_REQUEST_QUEUE", implode(",", $request_queue));

		// git stage 
		// git commit
		// git push

		echo json_encode($request);
	}

	function rejectRequest() {
		$request_id = "MVC_CMS_REQUEST_" . $_POST["request_id"];
		$request = json_decode(get_option($request_id));

		// update status and comment
		$user = wp_get_current_user();

		$request->rejection_reason = $_POST["comment"];
		$request->rejection_user = $user->display_name;
		$request->rejection_email = $user->user_email;

		// save
		update_option("MVC_CMS_REQUEST_" . $request->id, json_encode($request));

		// remove from queue
		// update request queue
		$request_queue = explode(",", get_option("MVC_CMS_REQUEST_QUEUE"));
		if (($key = array_search($request->id, $request_queue)) !== false) {
   			 unset($request_queue[$key]);
		}
		update_option("MVC_CMS_REQUEST_QUEUE", implode(",", $request_queue));

		cms_mail([$request->requester_email], "CMS Update Request " . $request["id"], "cms_request_rejection", $request);
	}

	function no_access() {
		return "{\"error\":\"no_access\"}";
	}

	function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }
    else {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }
}
?>