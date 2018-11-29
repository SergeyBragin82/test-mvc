<?php
$startMemory = 0;
$startMemory = memory_get_usage();
	require_once(dirname(__FILE__) . '/csv.php');
	require_once('mihertz.php');

function append_query_string($url) {
	if (strpos($a, 'ebrochures') !== false) {
    	$url = str_replace("-shtml/", ".shtml", $url);
	}
    return $url;
}

add_filter('the_permalink', 'append_query_string');
add_filter('get_permalink', 'append_query_string');

function mvc_add_search_exclude($id) {
	global $search_excludes;
	$search_excludes[] = $id;
}

function parse_tripadvisor() {
	global $cli;
	$tripadvisor_output = new SimpleXMLElement('<trip_advisor_data/>');
	$ta_xml = $tripadvisor_output->addChild("TripAdvisorCollection");
	$prefix = "..";
	if (!($cli==true)) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}
	$tripAdvisor = json_decode(file_get_contents($prefix . "/data/tripAdvisor.json"));
	foreach($tripAdvisor as $tripAdvisorObj) {
		$ta = $ta_xml->addChild('TripAdvisor');
		$ta->addAttribute('id', $tripAdvisorObj->ID);
		if(isset($tripAdvisorObj->COE)) {
			$ta->addAttribute('COE', (string)$tripAdvisorObj->COE[0]);
		}
		if(isset($tripAdvisorObj->TC)) {
			$ta->addAttribute('TC', (string)$tripAdvisorObj->TC[0]);
		}
	}
	return $tripadvisor_output;
}

function parse_loc() {
	$loc_output = new SimpleXMLElement('<loc_data/>');
	$prefix = "..";
	if (!($cli==true)) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}
	$loc_handle = fopen($prefix . "/data/loc/Phone_LOC_File.csv", "r");

	if($loc_handle) {
		$header_array = [];
		$header_parsed = false;
		$rowNum = 1;
		while(($row = fgetcsv($loc_handle, 0, ";", "\"")) !== FALSE) {
		   if (!$header_parsed) {
		   		$header_array = $row;
		   		$header_parsed = true;
		   } else {
		   		$values =  $row;
		   		if (count($header_array)===count($values)) {
					$row_node = $loc_output->addChild("Row");
			   		foreach($values as $idx => $value) {
			   			$clean_header = preg_replace('/[^A-Za-z0-9$]/', '', $header_array[$idx]);
			   			if($clean_header!="") {
								 if($clean_header === 'LOC') {
									$row_node->addAttribute($clean_header, htmlspecialchars(trim($value), ENT_DISALLOWED));
								 } else {
									$row_node->addChild($clean_header, htmlspecialchars(trim($value), ENT_DISALLOWED));
								 }	
			   			}
			   		}
		   		} else {
						echo 'Found mismatch between header and row column counts in ' . $id . '.csv table on row: '.$rowNum.'<br>Header columns are:'. count($header_array) . ' Row columns are:'.count($values).'<br><br>';
						foreach($values as $idx => $value) {
							if(substr($value, 0, 7)===" ") {
								echo ("mismatch on " . $id . " headers: " . count($header_array) . " values: " . count($values) . " (Breaks at " . $header_array[count($values)-1] . ")\r\n");
								echo ("data:" . $value);
							} else {
								echo "column[". $idx .".] ".$header_array[$idx]." = " . $value . "<br><br>";
							}
						}
		   		}
		   }
			 $rowNum++;
		}
	}
	return $loc_output;
}

function copy_resales() {
	// from user/resales to https://tpd1.www.marriottvacationclub.com/soa/rest/resales/grid.json
	copy("/user/resales/resales.csv", "/httpdocs/soa/rest/resales/grid.json");
}

function parse_osa() {
	global $cli;
	$prefix = "..";
	if (!($cli==true)) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}

	$file_handle = fopen($prefix . "/data/osa/osa.csv", "r");
	
	$output = new SimpleXMLElement("<OSAData/>");

	if($file_handle) {
		$header_array = [];
		$header_parsed = false;
		$rowNum = 1;
		while(($row = fgetcsv($file_handle, 0, ";", "\"")) !== FALSE) {
		   if (!$header_parsed) {
		   		$header_array = $row;
		   		$header_parsed = true;
		   } else {
		   		$values =  $row;
		   		if (count($header_array)===count($values)) {
					$row_node = $output->addChild("Row");
			   		foreach($values as $idx => $value) {
			   			$clean_header = preg_replace('/[^A-Za-z0-9$]/', '', $header_array[$idx]);
			   			if($clean_header!="") {
			   				if($clean_header=="$") 
			   					$clean_header = "currency";

			   				$value_clean = htmlspecialchars($value, ENT_COMPAT, "UTF-8");
				   			$row_node->addChild($clean_header, $value_clean);
				   			//if ($clean_header=="ActivityTitle" || $clean_header=="ActivityDetails") 
						   	//	echo "Adding " . $clean_header . " - \"" . htmlspecialchars($value) . "\"<BR>";	
				   			if ($value!="" && $value_clean=="") {
				   				echo "Parsing issue: " . $value_clean . "<BR>";
				   			}

			   			}
			   		}
		   		} else {
						echo 'Found mismatch between header and row column counts in ' . $id . '.csv table on row: '.$rowNum.'<br>Header columns are:'. count($header_array) . ' Row columns are:'.count($values).'<br><br>';
						foreach($values as $idx => $value) {
							if(substr($value, 0, 7)===" ") {
								echo ("mismatch on " . $id . " headers: " . count($header_array) . " values: " . count($values) . " (Breaks at " . $header_array[count($values)-1] . ")\r\n");
								echo ("data:" . $value);
							} else {
								echo "column[". $idx .".] ".$header_array[$idx]." = " . $value . "<br><br>";
							}
						}
		   		}
		   }
			 $rowNum++;
		}
	}
	return $output;
}

function parse_sct() {
	global $cli;
	$sct_output = new SimpleXMLElement("<sct_data/>");
	$exp_xml = $sct_output->addChild("ExperiencesCollection");

	$directory = '../data/sct/';

	$prefix = "..";
	if (!($cli==true)) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}
	

	if(strpos($_SERVER['SERVER_NAME'], 'localhost') === false){
		$experienceTypesData = json_decode(file_get_contents('/user/sct/Marketing_Website_SCT_Data_ExperienceTypes.json'));
		$experienceOptionsData = json_decode(file_get_contents('/user/sct/Marketing_Website_SCT_Data_ExperienceOptions.json'));
		$mapsData = json_decode(file_get_contents('/user/sct/Marketing_Website_SCT_Data_Maps.json'));
	} else {
		$experienceTypesData = json_decode(file_get_contents($prefix . "/data/sct/Marketing_Website_SCT_Data_ExperienceTypes.json"));
		$experienceOptionsData = json_decode(file_get_contents($prefix . "/data/sct/Marketing_Website_SCT_Data_ExperienceOptions.json"));
		$mapsData = json_decode(file_get_contents($prefix . "/data/sct/Marketing_Website_SCT_Data_Maps.json"));
	}
	
	// Experience Types collection
	$experiences = $experienceTypesData->ExperienceTypes;
	$idx = 0;
	foreach($experiences as $experience) {
		$exp = $exp_xml->addChild("ExperienceTypeCollection");
		$exp->addAttribute("id", $experience->Name);
		$inner_idx = 0;
		foreach ($experience->Vacations as $vacation) {
			$vacation_xml = $exp->addChild("Experience");
			$vacation_xml->addAttribute("LongDesc", $vacation->Detail->LongDesc);
			$vacation_xml->addAttribute("ShortDesc", $vacation->Detail->ShortDesc);
			$vacation_xml->addAttribute("Location", $vacation->Detail->Location);

			// Override for cruises only
			if (count($vacation->Detail->ImageURLs)>1 && $experience->Name=="Cruises") {
				$vacation_xml->addAttribute("ImageMainURL", $vacation->Detail->ImageURLs[0]);
			} else {
				$vacation_xml->addAttribute("ImageMainURL", $vacation->Detail->ImageMainURL);				
			}

			$inner_idx++;
			if($inner_idx==6) {
				break;
			} 
		}
		$idx++;
	}

	// Parse points data in Experience Options collection
	$points_xml = $sct_output->addChild("ExperiencesPointsCollection");
	$experiences = $experienceOptionsData->ExperienceOptions;
	$idx = 0;
	foreach($experiences as $experience) {
		$exp = $points_xml->addChild("ExperienceCollection");
		$points_lower = $experience->Filters[0]->Points[0];
		$points_upper = $experience->Filters[0]->Points[1];

		if($points_upper=="Above") {
			$points_upper = PHP_INT_MAX;
		}

		$exp->addAttribute("points_upper", $points_upper);
		$exp->addAttribute("points_lower", $points_lower);

		$inner_idx = 0;
		foreach ($experience->Vacations as $vacation) {
			$vacation_xml = $exp->addChild("Experience");
			$vacation_xml->addAttribute("LongDesc", $vacation->Detail->LongDesc);
			$vacation_xml->addAttribute("PointsUpper", $points_upper);
			$vacation_xml->addAttribute("PointsLower", $points_lower);
			$vacation_xml->addAttribute("ShortDesc", $vacation->Detail->ShortDesc);
			$vacation_xml->addAttribute("Location", $vacation->Detail->Location);
			$vacation_xml->addAttribute("SummaryArr", implode('t1234', $vacation->Detail->SummaryArr));
			if (isset($vacation->Detail->UnitType)) {
				$vacation_xml->addAttribute("UnitType", $vacation->Detail->UnitType);
			}
			

			// Override for cruises only
			if (count($vacation->Detail->ImageURLs) > 1 && $vacation->CollectionId == 1 && $vacation->SubCollectionId==4) {
				$vacation_xml->addAttribute("ImageMainURL", $vacation->Detail->ImageURLs[0]);
			} else {
				$vacation_xml->addAttribute("ImageMainURL", $vacation->Detail->ImageMainURL);				
			}
			$inner_idx++;
			if($inner_idx==6) {
				break;
			}
		}
		$idx++;
	}

	// Map Data
	$map_xml = $sct_output->addChild("ExperienceMapData");
	$map_data = $mapsData->Maps;
	$map_xml[0] = htmlspecialchars(json_encode($map_data));

	return $sct_output;
}


function parse_imagery($resort) {
	$url = "https://www.marriottvacationsworldwide.com/common/cms/mvc/images/resorts/galleries/_json/" . $resort->xpath("code")[0] . ".json";
	$json = file_get_contents($url);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$fileToSaveUrls = WP_PLUGIN_DIR . "/mvcweb/resortImagesUrl.txt";
	// clearing
	$json_object = json_decode($json);
	$response = '';
	if (json_last_error_msg() === 'No error') {
		$imagery = $resort->addChild('resort_imagery'); 
		$hasResortMap = (bool)(!empty((string)$json_object->resortMap));
		$imagery->addChild('hasResortMap', $hasResortMap === TRUE ? 'true' : 'false');
		foreach($json_object->items as $item) {
			$imageURL = "https://www.marriottvacationclub.com";
			$imageUrlArr = explode('/', htmlspecialchars($item->image));
			$imageName = rawurlencode (array_pop($imageUrlArr));
			array_push($imageUrlArr, $imageName);
			$imagePath = implode('/', $imageUrlArr);
			$imageURL .= $imagePath;
			$response .= $imageURL . PHP_EOL;
			$image = $imagery->addChild('image');
			if(strpos($_SERVER['SERVER_NAME'], 'localhost') === false){
				$image->addChild('image', '/wp-content/images/resorts' . rawurlencode($item->image));
			} else {
				$image->addChild('image', 'https://s23039.pcdn.co/wp-content/images/resorts' . rawurlencode($item->image));
			}
			$image->addChild('caption', htmlspecialchars($item->caption));
			$image->addChild('section', htmlspecialchars($item->section));
		}
	} else {
			echo 'There was an error parsing JSON for resort: ' . $resort->xpath('code')[0] . '<br> ' . json_last_error_msg() . "<br>";
			echo 'Returned json request was: ' . $json . '<br>';
	}
	$fp = fopen($fileToSaveUrls, 'a');
	fwrite($fp, $response);
	fclose($fp);
}


function parse_pcm() {
	global $cli;
	global $osadata;


	$fileToSaveUrls = WP_PLUGIN_DIR . "/mvcweb/resortImagesUrl.txt";
	// clearing
	file_put_contents($fileToSaveUrls, null);

	$output = new SimpleXMLElement("<mvcweb/>");

	$prefix = "..";
	if (!($cli==true)) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}
 
	// load the pcm parsing file
	$parse_pcm = simplexml_load_file($prefix . "/data/pcm_parser.xml");
	$tables = $parse_pcm->xpath("//table");

	$table_map = [];

	// foreach ($tables as $table) {
	// 	$id = (string)$table->xpath("@id")[0];
	// 	$table_node = $output->addChild($id . "Collection");
	// 	$table_map[$id] = $table_node;
	// 	$csvFileName = $prefix . "/data/pcm/" . $id . ".csv";
	// 	$lines = new CsvReader($csvFileName, ';');
	// 	if($lines) {
	// 		$header_parsed = false;
	// 		$header_array = [];
	// 		foreach($lines as $line_number => $values) {
	// 			print_r($values);
	// 			echo '<br><br><br>';
	// 			if (!$header_parsed) {
	// 				$header_array = $values;
	// 				$header_parsed = true;
	// 			} else {
	// 				if (count($header_array) == count($values)) {
	// 					$row_node = $table_node->addChild($id);
	// 					foreach($values as $idx => $value) {
	// 						$clean_header = preg_replace('/[^A-Za-z0-9]/', '', $header_array[$idx]);
	// 						$row_node->addChild($clean_header, htmlspecialchars($value, ENT_XML1));
	// 					}
	// 				} else {
	// 					if(substr($row, 0, 7)=="Output ") {
	// 						echo ("mismatch on " . $id . " headers: " . count($header_array) . " values: " . count($values) . " (Breaks at " . $header_array[count($values)-1] . ")\r\n");
	// 						echo ("data:" . $row);
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}
	// }
		
	foreach ($tables as $table) {
		$id = (string)$table->xpath("@id")[0];
		echo "Parsing " . $prefix . "/data/pcm/" . $id . ".csv" . "<BR>";
		$file_handle = fopen($prefix . "/data/pcm/" . $id . ".csv", "r");
		$table_node = $output->addChild($id . "Collection");

		$table_map[$id] = $table_node;

		if($file_handle) {
			$header_parsed = false;
			$header_array = [];
			$rowNum = 1;
			while(($row = fgetcsv($file_handle, 0, ";", "\"")) !== FALSE) {
			   if (!$header_parsed) {
			   		echo 'parsing header............... ' . implode(" ", $row) . "!<br><br>";
			   		$header_array = $row;
			   		$header_parsed = true;
			   		echo count($header_array) . " fields<br><br>";
			   } else {
			   		$values =  $row;
			   		if (count($header_array)===count($values)) {
						$row_node = $table_node->addChild($id);
				   		foreach($values as $idx => $value) {
				   			$clean_header = preg_replace('/[^A-Za-z0-9]/', '', $header_array[$idx]);
				   			$row_node->addChild($clean_header, htmlspecialchars($value, ENT_DISALLOWED));
				   		}
			   		} else {
							echo 'Found mismatch between header and row column counts in ' . $id . '.csv table on row: '.$rowNum.'<br>Header columns are:'. count($header_array) . ' Row columns are:'.count($values).'<br><br>';
							foreach($values as $idx => $value) {
								if(substr($value, 0, 7)===" ") {
									echo ("mismatch on " . $id . " headers: " . count($header_array) . " values: " . count($values) . " (Breaks at " . $header_array[count($values)-1] . ")\r\n");
									echo ("data:" . $value);
								} else {
									echo "column[". $idx .".] ".$header_array[$idx]." = " . $value . "<br><br>";
								}
							}
			   		}
			   }
				 $rowNum++;
			}
		}
	}

	$usa_regions_hash = array();
	$other_regions_hash = array();
	$region_hash_to_use = array();

	$resorts = $table_map['Resort']->xpath("Resort");

	$resort_index = new SimpleXMLElement("<resorts/>");
	foreach($resorts as $resort) {
		$resort_index_entry = $resort_index->addChild("resort");
		$resort_index_entry[0] = $resort->xpath("name")[0];
		$resort_index_entry->addAttribute("code", $resort->xpath("code")[0]);
		// generate permalink *** TODO : change this to be PCM driven or from another hardcoded data source as it cannot be generated algorithmically **
		$permalinkGenerated = strtolower($resort->xpath("marshaHotelCode")[0] . "-" . str_replace("--", "-", preg_replace('/[^A-Za-z0-9\-]|(sm)|(SM)/', '', str_replace(" ", "-", str_replace(" - ", "-", $resort->xpath("altName")[0])))));
		$resort->addChild('permalink', $permalinkGenerated);
		
		//echo "https://www.marriottvacationclub.com/common/cms/mvc/pdfs/resorts/calendars/" . strtolower($resort->xpath("code")[0]) . ".pdf" . "<BR>";
		//echo "https://www.marriottvacationclub.com/resales/images/featured/" . $resort->xpath("code")[0] . ".jpg" . "<BR>";
		echo $resort->xpath("pk")[0] . " " . $resort->xpath("code")[0] . " " . $resort->xpath("name")[0] . "<BR>";

		if ($resort->xpath("lookUpResortCode")[0]=="") {

			// embed fks in resorts
			$resortDataRows = import_table($table_map, $resort, 'ResortData', 'resortData');
			foreach($resortDataRows as $dataRow) {
				import_table($table_map, $dataRow, 'ResortDataInterests', 'pk');
			}
			import_table($table_map, $resort, 'ResortAddress', 'resortAddress');
			import_table($table_map, $resort, 'Olapic', 'pk', TRUE);

			$resort_features = import_table($table_map, $resort, 'ResortFeatures', 'resortFeatures');

			foreach($resort_features as $resort_feature) {
				import_table($table_map, $resort_feature, 'ResortFeaturesOptions', 'resortFeatures', true);
			}

			import_table($table_map, $resort, 'Brands', 'brands');

			// these are collections
			import_table($table_map, $resort, 'ExternalCodes', 'resort', true);
			import_table($table_map, $resort, 'LocalActivities', 'resort', true);
			$maps_info = import_table($table_map, $resort, 'MapAndTransportation', 'resort', TRUE);

			foreach($maps_info as $map_info) {
				$transports_info = import_table($table_map, $map_info, 'MVWCTransportInfo', 'mapAndTransportation', TRUE);
				foreach($transports_info as $transport_info) {
					import_table($table_map, $transport_info, 'Airports', 'mvwcTransportInfo', TRUE);
				}
			}


			$villas = import_table($table_map, $resort, 'VilaAmenities', 'resort', true);

			foreach($villas as $villa) {
				$options = import_table($table_map, $villa, 'VilaOptions', 'vilaAmenities', true);
				foreach ($options as $option) {
					
					import_table($table_map, $option, 'VilaDetails', 'vilaOptions', true);

					foreach($option->xpath("VilaDetailsCollection/VilaDetails") as $detail) {
						$detail_clean = "<div>" . str_replace("&", "&amp;", $detail->detail) . "</div>";	// fix for multiple top level xml elements
						$detail_clean = str_replace("class='", "class=\"", $detail_clean); 					// fix for single quotes to encapsulate attributes
						$detail_clean = str_replace("'>", "\">", $detail_clean);							// fix for single quotes to encapsulate attributes
						$detail_clean = str_replace("</span></p>", "</span>", $detail_clean);				// fix for extraneous closing </p> tags
						$detail_clean = str_replace("<p><span", "<span", $detail_clean);				// fix for extraneous closing </p> tags
						try {
						        @$detail_xml = new SimpleXMLElement($detail_clean);

										// extract subheader:
										$span = $detail_xml->xpath(".//span");
										$subheader = "";
										if ($span && count($span) > 0) {
											$subheader = $detail_xml->xpath(".//span")[0];
										}
										$list = "";
										$p = $detail_xml->xpath(".//p");
										if ($p && count($p) > 0) {
											$list = htmlspecialchars($detail_xml->xpath(".//p")[0]);
										}
										$ul = $detail_xml->xpath(".//ul");
										if ($ul && count($ul) > 0) {
											$list_xml = $detail_xml->xpath(".//ul")[0];
											if($list_xml) {
												$list = $list_xml->asXML();
											}
										}
						        //echo "RAW:" . htmlspecialchars($detail_clean) . "<BR><BR>";
						        //echo "SUBHEADER: " . $subheader . "<BR><BR>";
							    $detail->addChild("subheader", $subheader);
							    $detail->addChild("list", $list);
						    } catch (Exception $e) {
								echo "<b>DEBUG INFO: " . $resort->xpath("name")[0] . "</b><BR>";
						    	echo "OPTION: " . $option->villaTypeHeading .  "<BR>";
						    	echo "Failed to parse: " . $detail->title . "<BR>";
								echo htmlspecialchars($detail_clean) . "<BR><BR>";
								echo "Raw Field Data: " . htmlspecialchars($detail->detail) . "<BR><BR><br>";
						    }

						//echo htmlspecialchars($detail_xml->asXML()) . "<BR><BR>";
					}
				}

			}

			$floorplans = import_table($table_map, $resort, 'FloorPlan', 'resort', true);
			foreach($floorplans as $floorplan) {
				import_table($table_map, $floorplan, 'Media', 'floorPlanLargeImage');
				//echo "FLOORPLAN: " . $floorplan->xpath("Media/description")[0] . "<BR>";
				//echo htmlspecialchars($floorplan->asXML());
				// test for 404:
				//echo htmlspecialchars($floorplan->asXML()) . "<BR><BR>";
				//echo "testing for existence: https://tpd1.www.marriottvacationclub.com/wp-content/images/floorplans/" . $floorplan->xpath("Media/realFileName")[0] . "<br>";
				//$url = "https://owners.marriottvacationclub.com" . $floorplan->xpath("Media/URL")[0];
				//echo $url . " " . get_headers($url, 1)["0"] . "<BR>";
			}

			//echo "<BR><BR>";
			//echo "importing resortmaps<BR>";

			// Import Media for each resortmap
			$resortmaps = import_table($table_map, $resort, 'ResortMap', 'resort', true);
			foreach($resortmaps as $resortmap) {
				import_table($table_map, $resortmap, 'Media', 'resortMapPDF');
			}

			parse_imagery($resort);

			//echo "imagery parsed<BR>";
			$region_hash_to_use = &$usa_regions_hash;

			// construct region hash
			if ($resort->xpath("ResortAddress/country")[0]=="USA") {
				//echo 'USA<BR>';
				$region_hash = $resort->xpath("ResortAddress/city")[0] . ", " . $resort->xpath("ResortAddress/state")[0];
			} else {
				//echo 'Not USA<BR>';
				$region_hash = $resort->xpath("ResortAddress/city")[0] . ", " . $resort->xpath("ResortAddress/country")[0];
				$region_hash_to_use = &$other_regions_hash;
			}

			// Add to the given hash
			if(!$region_hash_to_use[$region_hash]) {
				$region_hash_to_use[$region_hash] = 0;
			}

			$region_hash_to_use[$region_hash]++;

			$resort->addAttribute("region", $region_hash);

			// activities
			$resort_activities = $osadata->xpath("//Row[code='" . $resort->xpath("code")[0] . "']");
			$osa_node = new SimpleXMLElement("<OSARowCollection/>");
			foreach($resort_activities as $resort_activity) {
				$resort_activity->addAttribute("id", guidv4());
				sxml_append($osa_node, $resort_activity, false);
			}

			$osa_option = "MVC_OSA_" . $resort->xpath("code")[0];
			if(!get_option($osa_option)) {
				update_option($osa_option, $osa_node->asXML());
			}

			// nuke the option
			$empty_xml = new SimpleXMLElement("<OSARowCollection/>");
			update_option($osa_option, $empty_xml->asXML());

			// workaround for broken data on some resort accommodation pages
			$villaCollection = $resort->xpath('.//VilaOptions');
			if(count($villaCollection)==0) {
				echo "Broken Resort: " . $resort->name . "<BR>";
				//$villaWorkaround->villaDiningHeading;</h3
				//$villaWorkaround->villaDiningOverview;
				$resort_options = "<div>" . $resort->xpath(".//villaDiningOverview")[0] . "</div>";
				$resort_options = str_replace("nbsp", "#160", $resort_options);

				echo htmlspecialchars($resort_options) . "<BR>";
				$villaXML = @new SimpleXMLElement($resort_options);

				// make fake xml from the parsed html blobs
				$vilaOptions = $resort->xpath(".//VilaOptionsCollection")[0];
				$accommodation_ul_node = $villaXML->xpath("ul")[0];
				$accommodation_node = $vilaOptions->addChild("VilaOptions");
				$accomodation_details_collection = $accommodation_node->addChild("VilaDetailsCollection");
				$details_accommodation_node = $accomodation_details_collection->addChild("VilaDetails");
				$details_accommodation_node->title = "Accommodations";
				$details_accommodation_node->subheader = "";
				$details_accommodation_node->list = $accommodation_ul_node->asXML();

				$lists = $villaXML->xpath("ul");

				foreach($villaXML->xpath("h3") as $idx => $h3) {
					$details_accommodation_node = $accomodation_details_collection->addChild("VilaDetails");
					$details_accommodation_node->title = (string)$h3;
					$details_accommodation_node->list = $lists[$idx+1]->asXML();
				}
			}
		} else {
			// this is a child resort
			$xpath = "Resort[code='" . $resort->xpath("lookUpResortCode")[0] . "']";
			$parent_resort = $table_map['Resort']->xpath($xpath)[0];

			$child_resorts = $parent_resort->xpath("ChildResortsCollection");

			if (count($child_resorts)==0) {
				$child_resorts = $parent_resort->addChild("ChildResortsCollection");
			} else {
				$child_resorts = $child_resorts[0];
			}

/*
			$villas = import_table($table_map, $parent_resort, 'VilaAmenities', 'resort', true);

			foreach($villas as $villa) {
				$villa->villaTypeHeading = $resort->xpath("resortDisplayName")[0] . ": " . $villa->villaTypeHeading;
				echo "CHILD VILLA: " . $villa->villaTypeHeading . "<BR/>";
				$options = import_table($table_map, $villa, 'VilaOptions', 'vilaAmenities', true);
				foreach ($options as $option) {
					import_table($table_map, $option, 'VilaDetails', 'vilaOptions', true);
					$floorplans = import_table($table_map, $parent_resort, 'FloorPlan', 'resort', true);
					foreach($floorplans as $floorplan) {
						import_table($table_map, $floorplan, 'Media', 'floorPlanLargeImage');
					}
				}

			}
*/

			$child_resort = $child_resorts->addChild("ChildResort");
			sxml_append($child_resort, $resort->xpath("marshaHotelCode")[0], false);
			sxml_append($child_resort, $resort->xpath("resortDisplayName")[0], false);
			sxml_append($child_resort, $resort->xpath("permalink")[0], false);

			delete_node($resort);
		}
	}

	// create template resorts 
	function create_template_resort($resort_index, $code, $title) {
		$return_resort = $resort_index->addChild("resort");
		$return_resort->addAttribute("code", $code);
		$return_resort[0] = $title;
		$empty_xml = new SimpleXMLElement("<OSARowCollection/>");
		update_option("MVC_OSA_" . $code, $empty_xml->asXML());
		return $return_resort;
	}

	create_template_resort($resort_index, "admin", "Activity Template Administration");

	echo "RI: " . htmlspecialchars($resort_index->asXML());
	update_option("MVC_RESORTS_INDEX", $resort_index->asXML());

	// Construct Regions
	$regions = $output->addChild("Regions");

	// USA Regions first
	foreach($usa_regions_hash as $region_key => $value) {
		$region = $regions->addChild("Region");
		$region->addAttribute("value", $region_key);
		$region->addAttribute("count", $value);
	}

	// Followed by global regions
	foreach($other_regions_hash as $region_key => $value) {
		$region = $regions->addChild("Region");
		$region->addAttribute("value", $region_key);
		$region->addAttribute("count", $value);
	}
	return $output;
}

function import_table($table_map, $to_node, $from_table, $fk, $backRef = false) {
	$table_result = array();
	if ($backRef) {
			$nodePk = $to_node->xpath("pk");
			if ($nodePk && count($nodePk) > 0) {
				$pk = $to_node->xpath("pk")[0];
				$xpath = $from_table . "[" . $fk . "='" . $pk . "']";
				//echo 'importing with backref from: ' . $from_table . ' to: ' . $to_node . ' with xpath: ' . $xpath . "<br><br>";
				$table_result = $table_map[$from_table]->xpath($xpath);
			}
			$result_collection = $to_node->addChild($from_table . 'Collection');
		} else {
			$nodeFk = $to_node->xpath($fk);
			if ($nodeFk && count($nodeFk) > 0) {
				$pk = $to_node->xpath($fk)[0];
				$xpath = $from_table . "[pk='" . $pk . "']";
				$table_result = $table_map[$from_table]->xpath($xpath);
			}
			$result_collection = $to_node;
		}
		//echo "COUNT: " . count($table_result) . "<br><br>";
		foreach ($table_result as $table_result_item) {
			sxml_append($result_collection, $table_result_item);
		}
		return $result_collection;
}

function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from, $clone = true) {
	if($from) {
	    $toDom = dom_import_simplexml($to);
	    $fromDom = dom_import_simplexml($from);

	    if ($clone) {
	    	$toDom->appendChild($fromDom->cloneNode(true));
	    } else {
	    	$toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
	    }
	}
}

function perform_publish() {
	global $cli;
	global $parse_config_data;
	global $sctdata;
	global $osadata;
	global $mvcdata;
	global $search_excludes;

	$prefix = "..";

	if (!$cli) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}

	// delete all posts

	echo "Deleting All Existing Pages.<BR>";
	$pages = get_pages();
	foreach($pages as $page) {
	    wp_delete_post($page->ID, true);
	}
        
        unset($pages);

	$parse_config_data = simplexml_load_file($prefix . "/data/mvcweb.xml");
	$configParams = $parse_config_data->xpath('//config_params')[0];
	foreach ($configParams as $configParam) {
		$val = (string)$configParam->xpath("./text()")[0];
		$key = (string)$configParam->xpath("@key")[0];
		echo "Securely storing config param: " . $key . ": " . $val . "<BR/>";
		update_option("MVC_CONFIG_" . $key, $val, true);
	}

	$activityParams = $parse_config_data->xpath('//activity_data')[0];
	update_option("MVC_ACTIVITY_DATA", $activityParams->asXML(), true);
	
	$excluded_resorts = array();
	foreach ($parse_config_data->xpath("//excluded_resorts/exclude/@code") as $code) {
		$excluded_resorts[] = $code;
	}

	$excluded_resorts_str = implode(",", $excluded_resorts);
	
	update_option("MVC_CONFIG_EXCLUDED_ACTIVITIES_RESORTS", $excluded_resorts_str, true);

	$parse_pages = simplexml_load_file($prefix . "/data/mvcpages.xml");
	// generate resort pages
	$osadata = parse_osa();
	$sctdata = parse_sct();
	$tripadvisordata = parse_tripadvisor();
	$mvcdata = parse_pcm();
	$locdata = parse_loc();

	copy_resales();

	update_option("MVC_LOC_DATA", $locdata->asXML(), true);

	sxml_append($mvcdata, $osadata, false);
	sxml_append($mvcdata, $sctdata, false);
	sxml_append($mvcdata, $tripadvisordata, false);


	//echo 'Parsed';
	// HOMEPAGE
	// Options:
	// page_on_front: id of homepage generated.
	// show_on_front: page

	$homepage_id = generate_page($parse_pages->xpath("//page[@permalink='/']")[0], NULL, $search_excludes);
	update_option("page_on_front", $homepage_id);
	echo "HOMEPAGE_ID" . $homepage_id . "<BR>";
	update_option("show_on_front", "page");

	$single_pages = $parse_pages->xpath("//single_pages/page");

	foreach($single_pages as $single_page) {
		parse_single_page($single_page, NULL, $mvcdata, $search_excludes);
	}
	parse_static($parse_pages->xpath("//static_import"), $search_excludes);

	echo count($search_excludes) . "<BR>";
	echo "Excluded posts: " . implode(",", $search_excludes) . "<BR>";
	foreach($search_excludes as $e) {
		echo get_permalink(get_post($e)) . "<BR>";
	}
	update_option("MVC_SEARCH_EXCLUDE", implode(",", $search_excludes));
echo (memory_get_usage() - $startMemory) . ' bytes' . PHP_EOL;
}

function parse_static($static_imports, &$search_excludes) {
	$prefix = "..";

	if (!$cli) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}

	foreach ($static_imports as $static_import) {
		
		$exclude_from_search = (string)$static_import->xpath("@search_exclude")[0]=="true" ? true : false;

		$parse_static = simplexml_load_file($prefix . "/data/static/" . $static_import->xpath("@file")[0]);
		foreach($parse_static->xpath("//static_page") as $static_page) {
			$title = $static_page->xpath("@title")[0];
			//$static_page->addAttribute("skip_theme", "true");
			$permalink = (string)$static_page->xpath("@permalink")[0];
			$permalink_tail_array = explode("/", $permalink);

			if(count($permalink_tail_array)>1) {
				$static_page->attributes()->permalink = $permalink_tail_array[count($permalink_tail_array)-1];
				$parent_id = deep_permalink_get_parent($permalink, $search_excludes);

				if ($parent_id==0) {
					$parent_id = url_to_postid("/");
				}

				$static_page->addAttribute("parent_page_id", $parent_id);				
			}
			$page_id = generate_page($static_page, $static_page, $search_excludes);
			if ($exclude_from_search) {
				echo ">>>> EXCLUDING " . $page_id . "<BR>";
				mvc_add_search_exclude($page_id);
			}
		}
	}
}

function deep_permalink_get_parent($permalink, &$search_excludes) {
	echo "raw permalink: " . $permalink . "<BR>";;
	if($permalink=="")
		return 0;

	$perm_array = explode("/", $permalink);
	array_pop($perm_array);

	$parent_permalink = implode("/", $perm_array);

	echo "seeking " . $parent_permalink . "/<BR>";
	$post_id = url_to_postid($parent_permalink . "/");

	if ($post_id==0) {
		echo "not found, going deeper<br>";
		$parent_post_id = deep_permalink_get_parent($parent_permalink, $search_excludes);

		$metadata = new SimpleXMLElement("<template/>");
		$metadata->addAttribute("permalink", $perm_array[count($perm_array)-1]);
		$metadata->addAttribute("template", "404");
		$metadata->addAttribute("parent_page_id", $parent_post_id);
		echo "creating " . $metadata->xpath("@permalink")[0] . " with parent " . get_permalink(get_post($parent_post_id)) . " <BR>";
		$newpage = generate_page($metadata, NULL, $search_excludes);

		// excluding autogenerated parent pages from search
		$search_excludes[] = $newpage;

		return $newpage;
	} else {
		echo "found " . get_permalink($post_id) . " w id " . $post_id . "<BR>";
		return $post_id;
	}
}

function parse_single_page($meta_data, $parent_id = NULL, $mvc_data=NULL, &$search_excludes) {

	if ($parent_id) {
		$meta_data->addAttribute("parent_page_id", $parent_id);
	}

	$page_data = NULL;

	// only include page_data if there is a filter function for it:
	if((count($meta_data->xpath("@data_filter"))>0 && $meta_data->xpath("@data_filter")[0]!='') || (count($meta_data->xpath("@resort_filter")) > 0 && $meta_data->xpath("@resort_filter")[0] != '')) {
		$page_data = $mvc_data;
	}

	$page_id = generate_page($meta_data, $page_data, $search_excludes);

	if ($meta_data->xpath("@search_exclude")[0]=="true") {
		$search_excludes[] = $page_id;
	}

	$children = $meta_data->xpath("page");
	foreach($children as $child) {
		parse_single_page($child, $page_id, $mvc_data, $search_excludes);
	}
}

function mvc_add_interest(&$collection, $code, $text) {
	$return_interest = $collection->addChild('Interest');
	$return_interest->addAttribute("code", $code);
	$return_interest->addAttribute("text", $text);
}

function generate_page($metadata, $page_data = NULL, $search_excludes = NULL) {
	global $parse_config_data;

	if(count($metadata->xpath("@data_filter")) > 0 && $metadata->xpath("@data_filter")[0] !== '') {
		$filter_function = (string)$metadata->xpath("@data_filter")[0];
		echo $filter_function . "!<BR>";
	} else if (count($metadata->xpath("@resort_filter")) > 0 && $metadata->xpath("@resort_filter")[0] !== '') {
		$resort_filter = (string)$metadata->xpath("@resort_filter")[0];
	}

	$page_xml = new SimpleXMLElement("<mvcweb/>");

	if ($filter_function && $filter_function != '') {
		echo "filter function: " . $filter_function . "<BR>";
		$page_xml = call_user_func_array($filter_function, [$page_data, $metadata, &$search_excludes]);
	} else if($resort_filter && $resort_filter != '') {
		echo $resort_filter . "<BR>";
		call_user_func_array($resort_filter, [$page_data, $metadata, &$search_excludes]);
	} else if($page_data) {
		sxml_append($page_xml, $page_data, false);
	}

	$prefix = "..";
	if (!($cli==true)) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}

	$template_node = $page_xml->addChild('template');
	$template_node->addAttribute("ebrochure_mode", $metadata->xpath("@ebrochure_mode")[0]);
	$template_node->addAttribute("name", $metadata->xpath("@template")[0]);
	$skip_theme = (string)$metadata->xpath("@skip_theme")[0];
	$template_node->addAttribute("skip_theme", $skip_theme);
	$skip_nav = (string)$metadata->xpath("@skip_nav")[0];
	$template_node->addAttribute("skip_nav", $skip_nav);

	$title = (string)$metadata->xpath("@title")[0];
	$template_node->addAttribute("title", $title);
	
	$template = (string)$metadata->xpath("@template")[0];
	$context = array('template' => $template);
	$sitemap = (string)$metadata->xpath("@sitemap")[0];

	$mime_type = (string)$metadata->xpath("@mime_type")[0];

	if (!$mime_type) {
		$mime_type = '';
	}

	if(!$sitemap) {
		$sitemap = 'true';
	}

	$excerpt = (string)$metadata->xpath("@excerpt")[0];

	if (!$excerpt || $excerpt=="") {
		$excerpt = "&nbsp;";
	}

	$page_array = array(
        'post_content' => $page_xml->asXML(),
        'post_content_filtered' => '',
        'post_title' => (string)$metadata->xpath("@title")[0],
        'post_excerpt' => $excerpt,
        'post_name' => (string)$metadata->xpath("@permalink")[0],
        'post_status' => 'publish',
        'post_type' => 'page',
        'comment_status' => '',
        'ping_status' => '',
        'post_password' => '',
        'to_ping' =>  '',
        'pinged' => '',
        'post_mime_type' => $mime_type,
        'post_parent' => (string)$metadata->xpath("@parent_page_id")[0],
        'menu_order' => $metadata->xpath("@menu_order")[0],
        'guid' => '',
				'import_id' => 0,
				'context' => $template,
    );
    echo "Generating for " . $page_array['post_title'] . " " . $page_array['post_name'] . " " . $mime_type ."<BR>";

    $content_post = get_posts( array( 'name' => $page_array['post_name'] ) );
	if( count($content_post)>0 )
	{
		//echo "UPDATING EXISTING PAGE: " . $page_array['post_name'];
	    return wp_update_post($page_array);
	} else {
		//echo "INSERTING NEW PAGE: " . $page_array['post_name'];
		$newpost = wp_insert_post($page_array);
		echo "<a href='";
		echo the_permalink($newpost);
		echo "'>";
		echo the_permalink($newpost);
		echo "</a> ID: " . $newpost . " <BR>";
		return $newpost;
	}

}

$search_excludes = [];
$cli = FALSE;
if ($cli) {
	if ($enum) {
		echo mvc_resorts_page_filter(parse_pcm())->asXML();
	} else if ($debug) {
		parse_pcm();
	} else {
		echo parse_pcm()->asXML();
	}
}

function delete_node($node)
{
    $node=dom_import_simplexml($node);
    $parent=$node->parentNode;
    $parent->removeChild($node);
}

function mvc_pulse_resorts_filter($page_data, $metadata = NULL, $search_excludes = NULL) {
	$filtered_page_data = new SimpleXMLElement("<mvcweb/>");
	$resort_collection = $filtered_page_data->addChild("Resorts");
	foreach ($page_data->xpath("//Resort") as $resort) {
		if(strpos($resort->name, 'Pulse') !== false) {
			$resort_filtered = $resort_collection->addChild('Resort');
			sxml_append($resort_filtered, $resort->xpath("name")[0], false);
			sxml_append($resort_filtered, $resort->xpath("disclaimer")[0], false);
			sxml_append($resort_filtered, $resort->xpath("ResortAddress/city")[0], false);
			sxml_append($resort_filtered, $resort->xpath("ResortAddress/state")[0], false);
			sxml_append($resort_filtered, $resort->xpath("ResortAddress/country")[0], false);
			sxml_append($resort_filtered, $resort->xpath("permalink")[0], false);
			sxml_append($resort_filtered, $resort->xpath("description")[0], false);
			sxml_append($resort_filtered, $resort->xpath("ResortData/mvwcExchangeResorts")[0], false);
			sxml_append($resort_filtered, $resort->xpath("ResortData/mvwcTrustResorts")[0], false);
			sxml_append($resort_filtered,
			$resort->xpath("ResortData/ResortDataInterests/interests")[0], false);

			$image_node = $resort->xpath("resort_imagery/image[section='Hero']");
			if (count($image_node)>0) {
				sxml_append($resort_filtered, $image_node[0], false);
			}
		}
	}
	return $filtered_page_data;
}

function mvc_resorts_generate($page_data, $metadata = NULL, &$search_excludes) {
	foreach ($page_data->xpath("//Resort") as $resort) {

		$ebrochure = $metadata->xpath("@ebrochure_mode")[0];

		// create resort landing page metadata node
		$resort_landing = new SimpleXMLElement("<page/>");
		$resort_landing->addAttribute("permalink", strtolower($resort->xpath("permalink")[0]));
		$resort_landing->addAttribute("template", "resorts/resort-overview");
		$resort_landing->addAttribute("title", $resort->xpath("altName")[0]);
		$resort_landing->addAttribute("parent_page_id", $metadata->xpath("@parent_page_id")[0]);
		$resort_landing->addAttribute("excerpt", (string)$resort->xpath("description")[0]);
		$resort_landing->addAttribute("ebrochure_mode", (string)$metadata->xpath("@ebrochure_mode")[0]);

		if ((string)$metadata->xpath("@ebrochure_mode")[0]!="true") {
			$tripAdvisorCode = $resort->xpath('.//tripAdvisorCode')[0];
			$tripAdvisorData = $page_data->xpath("//TripAdvisor[@id='".(string)$tripAdvisorCode."']")[0];
			if($tripAdvisorData) {
				sxml_append($resort, $tripAdvisorData, false);
			}
		}

		$resortXML = (string)$resort->asXML();
		$resort_landing_id = generate_page($resort_landing, new SimpleXMLElement($resortXML), $search_excludes);

		if($ebrochure) {
				mvc_add_search_exclude($resort_landing_id);
		}

		foreach($metadata->xpath("per_resort_pages/page") as $resort_page_template) {
			$ebrochure = $resort_page_template->xpath("@ebrochure_mode")[0]=="true";
			// clone first
			$subtitle = (string)$resort_page_template->xpath("@subtitle")[0];
			$resorttitle = (string)$resort->xpath("name")[0];
			// This is the same string but without html tags
			$resortAltName = (string)$resort->xpath("altName")[0];
			$resort_page = new SimpleXMLElement("<page/>");
			$resort_page->addAttribute("permalink", (string)$resort_page_template->xpath("@permalink")[0]);

			if ($subtitle!="") {
				$resort_page->addAttribute("title", $resortAltName . " - " . $subtitle);
			}
			$resort_page->addAttribute("ebrochure_mode", (string)$resort_page_template->xpath("@ebrochure_mode")[0]);			
			$resort_page->addAttribute("template", (string)$resort_page_template->xpath("@template")[0]);
			$resort_page->addAttribute("excerpt", (string)$resort->xpath("description")[0]);
			$resort_page->addAttribute("skip_theme", (string)$resort_page_template->xpath("@skip_theme")[0]);
			$resort_page->addAttribute("mime_type", (string)$resort_page_template->xpath("@mime_type")[0]);
			$resort_page["parent_page_id"] = $resort_landing_id;
			$page_id = generate_page($resort_page, new SimpleXMLElement($resortXML), $search_excludes);

			if ($ebrochure) {
				mvc_add_search_exclude($page_id);
			}

			/*Create subpages in per_resort_pages*/
			foreach ($resort_page_template->xpath("page") as $sub_page_template) {
                resort_pages_generate_sub_page($resort, $page_id, $sub_page_template, $subtitle, $search_excludes);
			}
		}
	}
}

function resort_pages_generate_sub_page($resort, $resort_landing_id, $resort_page_template, $resort_page_title, $search_excludes) {
    $subtitle = (string)$resort_page_template->xpath("@subtitle")[0];
    // This is the same string but without html tags
    $resortAltName = (string)$resort->xpath("altName")[0];

    $resort_page = new SimpleXMLElement("<page/>");

	/*----Add code of resort to page for /vacation-resorts/[name]/activities/json----*/
    if (count($resort_page_template->xpath("@resort_activities_filter")) > 0 && $resort_page_template->xpath("@resort_activities_filter")[0] !== '') {
        $code = (string)$resort->xpath("code")[0];
        $resort_page->addAttribute("code", $code);
    }

    $resort_page->addAttribute("permalink", (string)$resort_page_template->xpath("@permalink")[0]);

    if ($subtitle!="") {
        $resort_page->addAttribute("title", $resortAltName . " - " . $resort_page_title . " - " . $subtitle);
    }

    $resort_page->addAttribute("ebrochure_mode", (string)$resort_page_template->xpath("@ebrochure_mode")[0]);
    $resort_page->addAttribute("template", (string)$resort_page_template->xpath("@template")[0]);
    $resort_page->addAttribute("excerpt", (string)$resort->xpath("description")[0]);
    $resort_page->addAttribute("skip_theme", (string)$resort_page_template->xpath("@skip_theme")[0]);
    $resort_page->addAttribute("mime_type", (string)$resort_page_template->xpath("@mime_type")[0]);
    $resort_page["parent_page_id"] = $resort_landing_id;
    $page_id = generate_page($resort_page, $resort_page, $search_excludes);
}

function mvc_ebrochures_generate($page_data, $metadata = NULL, &$search_excludes) {

	echo "ebrochures<BR>";
	global $mvcdata;
	global $search_excludes;
	$prefix = "..";
	if (!($cli==true)) {
		$prefix = WP_PLUGIN_DIR . "/mvcweb";
	}

	$file_handle = fopen($prefix . "/data/ebrochures/ebrochures.csv", "r");
	
	if($file_handle) {
		$header_array = [];
		$header_parsed = false;
		$rowNum = 1;
		while(($row = fgetcsv($file_handle, 0, ";", "\"")) !== FALSE) {
		   if (!$header_parsed) {
		   		$header_array = $row;
		   		$header_parsed = true;
		   } else {
		   		$values =  $row;
		   		echo "Ebrochures: " . $rowNum . " " . $values[0] ."<BR>";
		   		if (count($header_array)===count($values)) {
					$resort = $page_data->xpath("//Resort[code='" . $values[0] . "']")[0];

					if ($resort) {
						$url = $values[1];

						// create resort landing page metadata node
						$ebrochure_landing = new SimpleXMLElement("<page/>");
						$ebrochure_landing->addAttribute("permalink", "/" . $url);
						$ebrochure_landing->addAttribute("template", "404");
						$ebrochure_landing->addAttribute("title", "Ebrochures");
						$ebrochure_landing->addAttribute("parent_page_id", $metadata->xpath("@parent_page_id")[0]);
						$ebrochure_landing->addAttribute("excerpt", "&nbsp;");
						$ebrochure_landing->addAttribute("search_exclude", $metadata->xpath("@search_exclude")[0]);
						$ebrochure_landing_id = generate_page($ebrochure_landing, new SimpleXMLElement("<ebrochures/>"), $search_excludes);
						mvc_add_search_exclude($ebrochure_landing_id);
						foreach($metadata->xpath("per_resort_pages/page") as $resort_page_template) {

							$resort_page = new SimpleXMLElement("<page/>");
							$resort_page->addAttribute("permalink", $resort_page_template->xpath("@permalink")[0]);
							$resort_page->addAttribute("title", $resort_page_template->xpath("@subtitle")[0]);
							$resort_page->addAttribute("template", (string)$resort_page_template->xpath("@template")[0]);
							$resort_page->addAttribute("skip_theme", (string)$resort_page_template->xpath("@skip_theme")[0]);
							$resort_page->addAttribute("skip_nav", "true");
							$resort_page->addAttribute("excerpt", "&nbsp;");
							$resort_page->addAttribute("search_exclude", (string)$resort_page_template->xpath("@search_exclude")[0]);
							$resort_page["parent_page_id"] = $ebrochure_landing_id;
							$page_id = generate_page($resort_page, new SimpleXMLElement($resort->asXML()), $search_excludes);
							mvc_add_search_exclude($page_id);
						}			   								
					} else {
						echo 'ERROR: Cannot find resort for ' . $values[0] . "<BR>";
					}
		   		} else {
						echo 'Found mismatch between header and row column counts in ' . $id . '.csv table on row: '.$rowNum.'<br>Header columns are:'. count($header_array) . ' Row columns are:'.count($values).'<br><br>';
						foreach($values as $idx => $value) {
							if(substr($value, 0, 7)===" ") {
								echo ("mismatch on " . $id . " headers: " . count($header_array) . " values: " . count($values) . " (Breaks at " . $header_array[count($values)-1] . ")\r\n");
								echo ("data:" . $value);
							} else {
								echo "column[". $idx .".] ".$header_array[$idx]." = " . $value . "<br><br>";
							}
						}
		   		}
		   }
			 $rowNum++;
		}
	}
}

// PAGE SPECIFIC Data Filtering

// These functions filter the master MVCData down into smaller versions and contain only data pertinent to that page.
function mvc_resorts_page_filter($page_data, $metadata) {
	$filtered_page_data = new SimpleXMLElement("<mvcweb/>");

	$interests_enum = $filtered_page_data->addChild("Interests");

	mvc_add_interest($interests_enum, 'GOLF', 'Golf');
	mvc_add_interest($interests_enum, 'URBAN', 'Urban');
	mvc_add_interest($interests_enum, 'THEME_PARK', 'Theme Parks');
	mvc_add_interest($interests_enum, 'BEACH', 'Beach');
	mvc_add_interest($interests_enum, 'SKI', 'Ski');

	$resort_collection = $filtered_page_data->addChild("Resorts");
	foreach ($page_data->xpath("//Resort") as $resort) {
		// create resort landing page metadata node
		$resort_filtered = $resort_collection->addChild("Resort");
		$resort_filtered->addAttribute("region", $resort->xpath("@region")[0]);
		$resort_filtered->addAttribute("code",
		$resort->xpath("code")[0]);
		sxml_append($resort_filtered, $resort->xpath("name")[0], false);
		sxml_append($resort_filtered, $resort->xpath("disclaimer")[0], false);
		sxml_append($resort_filtered, $resort->xpath("ResortAddress/city")[0], false);
		sxml_append($resort_filtered, $resort->xpath("ResortAddress/state")[0], false);
		sxml_append($resort_filtered, $resort->xpath("ResortAddress/country")[0], false);
		sxml_append($resort_filtered,
		$resort->xpath('ResortAddress/region')[0], false);
		sxml_append($resort_filtered, $resort->xpath("permalink")[0], false);
		sxml_append($resort_filtered, $resort->xpath("description")[0], false);
		sxml_append($resort_filtered, $resort->xpath("Brands/code")[0], false);
		sxml_append($resort_filtered, $resort->xpath("ResortData/mvwcExchangeResorts")[0], false);
		sxml_append($resort_filtered, $resort->xpath("ResortData/mvwcTrustResorts")[0], false);
		sxml_append($resort_filtered,
		$resort->xpath("ResortData/ResortDataInterests/interests")[0], false);

		$image_node = $resort->xpath("resort_imagery/image[section='Hero']");
		if (count($image_node)>0) {
			sxml_append($resort_filtered, $image_node[0], false);
		}
	}

	$regions_enum = $filtered_page_data->addChild("Regions");
	foreach ($page_data->xpath("//Region") as $region) {

		sxml_append($regions_enum, $region, false);
	}

	return $filtered_page_data;
}

function mvc_sct_experience_filter($page_data, $metadata) {
	$filtered_page_data = new SimpleXMLElement("<mvcweb/>");

	sxml_append($filtered_page_data, $page_data->xpath("//ExperienceTypeCollection[@id='" . $metadata->xpath("@sct_index")[0] . "']")[0], false);

	return $filtered_page_data;
}

function mvc_sct_experience_points_filter($page_data, $metadata) {
	$filtered_page_data = new SimpleXMLElement("<mvcweb/>");
	sxml_append($filtered_page_data, $page_data->xpath("//ExperiencesPointsCollection")[0], false);
	return $filtered_page_data;
}

function mvc_sct_destinations_filter($page_data, $metadata) {
	$filtered_page_data = new SimpleXMLElement("<mvcweb/>");
	sxml_append($filtered_page_data, $page_data->xpath("//ExperienceMapData")[0], false);
	return $filtered_page_data;	
}
?>
