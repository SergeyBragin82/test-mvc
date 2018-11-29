<?php
	require_once(dirname(__DIR__) . '/classes/column_item_content.php');
	require_once(dirname(__DIR__) . '/classes/masonry_item.php');
	require_once(dirname(__DIR__) . '/classes/resort_icon_content_item.php');
	require_once(dirname(__DIR__) . '/api/olapic.php');
    require_once(dirname(__DIR__) . '/general-information/metas.php');

	function DOMinnerHTML(DOMNode $element) {
		$innerHTML = "";
		$children = $element->childNodes;
		foreach($children as $child) {
			$innerHTML .= $element->ownerDocument->saveHTML($child);
		}
		return $innerHTML;
	}
	function randomRange($min, $max, $count) {
		$range = array();
    while ($i++ < $count) {
        while(in_array($num = mt_rand($min, $max), $range));
        $range[] = $num;
    }
    return $range;
	}

	function isXmlNodeValid($node) {
		return $node && count($node) > 0;
	}

	function getMediaMasonry($count) {
		$media = getMediaOfCustomer();
		if($media) {
			$customerMediaImgURLs = getMediaUrl($media['data']);
			$numOfItems = count($customerMediaImgURLs);
			$randomRange = randomRange(0, $numOfItems - 1, $count);
			shuffle($randomRange);
			$masonryItems = array();
			foreach($randomRange as $number) {
				$masonryItems[] = (object)(array(
					 'imgPath' => $customerMediaImgURLs[$number]['normal'],
					 'imgAlt' => 'Olapic Stream Image ' . $number,
				 ));
			}
			return $masonryItems;
		}
		return NULL;
	}

	function getResortMasonry($olapicID) {
		if(!emptyOrNull($olapicID)) {
			$streamInfo = getStreamByKey($olapicID);
			if($streamInfo) {
				$mediaData = getMediaOfStream($streamInfo['data']['id']);
				if($mediaData) {
					$streamMediaImgURLs = getMediaUrl($mediaData['data']);
					$masonryItems = array(
					 0 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[0]['normal'],
						 'imgAlt' => 'Olapic Stream Image 1'
					 )),
					 1 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[1]['normal'],
						 'imgAlt' => 'Olapic Stream Image 2'
					 )),
					 2 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[2]['normal'],
						 'imgAlt' => 'Olapic Stream Image 3'
					 )),
					 3 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[3]['normal'],
						 'imgAlt' => 'Olapic Stream Image 4'
					 )),
					 4 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[4]['normal'],
						 'imgAlt' => 'Olapic Stream Image 5'
					 )),
					 5 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[5]['normal'],
						 'imgAlt' => 'Olapic Stream Image 6'
					 )),
					 6 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[6]['normal'],
						 'imgAlt' => 'Olapic Stream Image 7'
					 )),
					 7 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[7]['normal'],
						 'imgAlt' => 'Olapic Stream Image 8'
					 )),
					 8 => (object)(array(
						 'imgPath' => $streamMediaImgURLs[8]['normal'],
						 'imgAlt' => 'Olapic Stream Image 9'
					 ))
				 );
				 return $masonryItems;
				}
			}
		}
		return NULL;
	}

	/**
	 * Generic method to get an image tag element
	 * @method getImageTag
	 * @param  string      $imgUrl        The url of the image
	 * @param  string      $altName         Alt name for image element
	 * @param  array      $extraClassNames A list of additional classes that you want to be applied to the element
	 * @return string                       The string representing the html element
	 */
	function getImageTag($imgUrl, $altName, array $extraClassNames = NULL, $isRemote = FALSE) {
		$toReturn;
		if($isRemote) {
			$toReturn = "<img src='" . $GLOBALS['img_path'] . $imgUrl . "' alt=\"" . $altName . "\" ";
		} else {
			$toReturn = "<img src='" . $imgUrl . "' alt=\"" . $altName . "\" ";
		}
		if (!is_null($extraClassNames) && is_array($extraClassNames) && !empty($extraClassNames)) {
			$toReturn .= "class='" . implode(' ', $extraClassNames) . "'";
		}
		$toReturn .= "/>";
		return $toReturn;
	}
	function getImageOverlay($imgOverlay, $imgID) {
		$toReturn;
			$toReturn = "<img data-lazy='" . $GLOBALS['img_path'] . $imgOverlay . "' id='" . $imgID . " />";
		return $toReturn;
	}
	function getImageTagCarouselLazy($imgUrl, $altName, array $extraClassNames = NULL, $isRemote = FALSE) {
		$toReturn;
		if($isRemote) {
			$toReturn = "<img data-lazy='" . $GLOBALS['img_path'] . $imgUrl . "' data-alt=\"" . $altName . "\" ";
		} else {
			$toReturn = "<img data-lazy='" . $imgUrl . "' data-alt=\"" . $altName . "\" ";
		}
		if (!is_null($extraClassNames) && is_array($extraClassNames) && !empty($extraClassNames)) {
			$toReturn .= "class='" . implode(' ', $extraClassNames) . "'";
		}
		$toReturn .= "/>";
		return $toReturn;
	}

	function getCountryList() {
		return <<<HTML
    <option value="United States">United States</option>
    <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antartica">Antarctica</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
    <option value="Botswana">Botswana</option>
    <option value="Bouvet Island">Bouvet Island</option>
    <option value="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Christmas Island">Christmas Island</option>
    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo">Congo</option>
    <option value="Congo">Congo, the Democratic Republic of the</option>
    <option value="Cook Islands">Cook Islands</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
    <option value="Croatia">Croatia (Hrvatska)</option>
    <option value="Cuba">Cuba</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
    <option value="Denmark">Denmark</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="East Timor">East Timor</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="France Metropolitan">France, Metropolitan</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories">French Southern Territories</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Greece">Greece</option>
    <option value="Greenland">Greenland</option>
    <option value="Grenada">Grenada</option>
    <option value="Guadeloupe">Guadeloupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
    <option value="Holy See">Holy See (Vatican City State)</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran (Islamic Republic of)</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
    <option value="Korea">Korea, Republic of</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Lao">Lao People's Democratic Republic</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia">Micronesia, Federated States of</option>
    <option value="Moldova">Moldova, Republic of</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Namibia">Namibia</option>
    <option value="Nauru">Nauru</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="Netherlands Antilles">Netherlands Antilles</option>
    <option value="New Caledonia">New Caledonia</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="Niue">Niue</option>
    <option value="Norfolk Island">Norfolk Island</option>
    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Pitcairn">Pitcairn</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Reunion">Reunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russian Federation</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
    <option value="Saint LUCIA">Saint LUCIA</option>
    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovakia">Slovakia (Slovak Republic)</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
    <option value="Spain">Spain</option>
    <option value="SriLanka">Sri Lanka</option>
    <option value="St. Helena">St. Helena</option>
    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
    <option value="Swaziland">Swaziland</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syrian Arab Republic</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania, United Republic of</option>
    <option value="Thailand">Thailand</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos">Turks and Caicos Islands</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Viet Nam</option>
    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
    <option value="Western Sahara">Western Sahara</option>
    <option value="Yemen">Yemen</option>
    <option value="Yugoslavia">Yugoslavia</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>
HTML;
	}

	//Takes care of escaping and converting all special characters
	//to make it compatible with javascript
	function escapeJavaScriptText($string)
	{
	    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
	}

	/**
	 * Returns an html list element with image and content
	 * aligned with image
	 * @method listItem
	 * @param  string   $headerText    Desired text for header
	 * of content
	 * @param  string   $paragraphText Desired text for paragraph of content
	 * @param  string   $imageSrc      Name of image with file extensions
	 * @param  string   $imageAlt      Alt description for image.
	 * @return string                  returns html string for element
	 */
	function listItem($headerText, $paragraphText, $imageSrc, $imageAlt) {
		$imageElement;
		if(!emptyOrNull($imageSrc)) {
			$imageElement = getImageTag($imageSrc, $imageAlt, NULL, true);
		}
		$paragraphContent = $paragraphText;
		return <<<HTML
		<li>
			<div class="item-content">
				<div class="item-description">
					<h4>
						$headerText
					</h4>
					<p>
						$paragraphContent
					</p>
				</div>
			</div>
		</li>
HTML;
	}

	/**
	 * Helper method to display a column element with picture and content
	 * @method columnListItemWithPicture
	 * @param  array  $contentArray Array of ColumnItemContent objects describing data that needs to be displayed
	 * @return string A string representing the html element to be displayed
	 */
	function columnListItemWithPicture(array $contentArray) {
		if (!is_array($contentArray) || empty($contentArray)) {
			return;
		}
		$htmlToReturn = "
			<div class='container-fluid image-description-container'>\n
				<div class='row'>\n
		";
		foreach ($contentArray as $contentItem) {
			$htmlToReturn .= "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4'>\n<div class='image-description-parent image-description-border'>\n";
			$itemHtml = getImageTag(
				$contentItem->imgPath,
				$contentItem->imgAlt,
				NULL,
				true
			);
			if (is_null($contentItem->extraClasses) ||
				empty($contentItem->extraClasses)) {
					$itemHtml .= "\n<div class='text-content'>\n";
				} else {
					$itemHtml .= "\n<div class='text-content ";
					foreach ($contentItem->extraClasses as $class) {
						$itemHtml .= $class . " ";
					}
					$itemHtml .= "'>\n";
				}
			$itemHtml .=
			"<h4>"
			. htmlentities($contentItem->contentHeader, ENT_HTML5)
			. "</h4>\n"
			. "<p>"
			. $contentItem->contentParagraph
			. "</p>\n";
			$buttonHtml = '';
			if (!empty($contentItem->buttonText) && !is_null($contentItem->buttonText)) {
				$buttonHtml .= "<div class='text-center image-description-button'>\n";
				if(empty($contentItem->buttonID)) {
					$buttonHtml .= "<a class='btn marriott-btn' href='"
					. $contentItem->buttonHref
					. "' role='button'>\n"
					. $contentItem->buttonText
					. "\n</a>\n</div>\n";
				} else {
					$buttonHtml .= "<a class='btn marriott-btn' id='" . $contentItem->buttonID . "' href='"
					. $contentItem->buttonHref
					. "' role='button'>\n"
					. $contentItem->buttonText
					. "\n</a>\n</div>\n";
				}
			}
			$htmlToReturn .= $itemHtml . "</div>". $buttonHtml ."\n</div>\n</div>\n";
		}
		$htmlToReturn .= "</div>\n</div>\n";
		return $htmlToReturn;
	}

	function horizontalBreak() {
		return "<div class='break'>\n
			<hr />\n
		</div>\n";
	}

	function emptyOrNull($element) {
		return is_null($element) || empty($element);
	}

	function inspirationBlogElement($header, $subtitle, $btnText, $href, $image, $imageAlt) {
		$imageElement = getImageTag($image, $imageAlt, NULL, TRUE);
		return <<<HTML
		<a href='$href' target="_blank">
					$imageElement
				<div class='item-content-container text-center'>
					<div class='content'>
						<h3 class='title header-underline'>$header</h3>
						<h4 class='subtitle'>$subtitle</h4>
						<div class='btn'>more</div>
					</div>
				</div>
		</a>
HTML;
	}

	function masonry(array $items = NULL, $itemsLocal = FALSE) {
		$toReturn = "";
		if (!emptyOrNull($items)) {
			$toReturn = "<div class='image-masonry'>\n";
			foreach ($items as $item) {
				$toReturn .= "<div class='masonry-item'>\n" . getImageTag($item->imgPath, $item->imgAlt, NULL, $itemsLocal) . "\n</div>\n";
			}
			$toReturn .= "</div>\n";
		}
		return $toReturn;
	}

	function performGetRequest($url, $returnJSON = TRUE, $arrayJSON = TRUE) {
		$request = wp_remote_get($url);
		if( is_wp_error($request)) {
			return NULL;
		}
		$body = wp_remote_retrieve_body($request);
		if ($returnJSON) {
			return json_decode($body, $arrayJSON);
		}
		return $body;
	}

	function destinationPageContent($header, $subHeader, $experiences, $alttags){
		$experienceElements = displayExperiences($experiences, $alttags);
		return <<<HTML
		<div class='destinations-container'>
			<h2 class='destinations-center-header'>
				$header
			</h2>
			<p style='text-align: center;'>$subHeader</p>
			<div class='container-fluid resort-preview-container'>
				<div class='row'>
					$experienceElements
				</div>
			</div>
		</div>
HTML;
	}

	function displayExperiences($experiences, $alttags) {
		$html = "<div class='container-fluid resort-preview-container'><div class='row'>";
		
		foreach ($experiences as $idx => $experience) {
			$html .= 
				"<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4' style='display:flex;'>" . destinationElementPreview($experience, $alttags[$idx]) . 
				"</div>";
		}
		$html .= "</div></div>";
		return $html;
	}

	function destinationElementPreview($resortInfo = NULL, $alttag) {
		$image = getImageTag('sct_content/' . $resortInfo->xpath("@ImageMainURL")[0], $alttag, NULL, true);
		$title = $resortInfo->xpath("@ShortDesc")[0];
		$desc = $resortInfo->xpath("@LongDesc")[0];
		return <<<HTML
		<div class='resort-preview-parent'>
			$image
			<div class='info-container pb-3'>
				<div class='info-accent'></div>
				<div class="readmore-resort-description">
					<h3 class='title'>
						$title
					</h3>
					<div class='text'>
						$desc
					</div>
				</div>
				<div class='fadeout'></div>
			</div>
		</div>
HTML;
	}

	function vacationGreatnessIntro() {
		return <<<HTML
		<div class="container text-center vacation-greatness">
			<h3 class="vacation-greatness-subheader">
				#vacationgreatness
			</h3>
			<h2 class="vacation-greatness-header">
				See How We Vacation
			</h2>
			<p class="vacation-greatness-content">
				See how our Owners are living the vacation lifestyle. View and share your own #VACATIONGREATNESS photos, videos and memorable moments.
			</p>
		</div>
HTML;
	}


	function phoneNumberTemplate($phoneNumber, $overrideText = NULL, $usePeriod = FALSE) {
		$phoneString = emptyOrNull($overrideText) ? $phoneNumber : $overrideText;
		if ($usePeriod===TRUE) {
			$phoneString .= '.';
		}
		return <<<HTML
		<span itemprop='telephone'>
			<a class='telephone-number' href='tel:+$phoneNumber'>
				$phoneString
			</a>
		</span>
HTML;
	}

	function phoneNumberTemplateMobileHeader($phoneNumber, $overrideText = NULL, $usePeriod = FALSE) {
		$phoneString = emptyOrNull($overrideText) ? $phoneNumber : $overrideText;
		if ($usePeriod===TRUE) {
			$phoneString .= '.';
		}
		return <<<HTML
		<a href="tel:+$phoneNumber">
			<div  class="mobile-menu-call">
				learn more <span class='phone-number'>$overrideText</span>
			</div>
		</a>
HTML;
	}

	function resortAmenitiesItemDescriptionTemplate(ResortIconContent $obj) {
		if(isset($obj)) {
			$img = getImageTag($obj->imgSrc, $obj->imgAlt, NULL, TRUE);
		}
		return <<<HTML
		<div class='col-12 col-sm-10 offset-sm-1'>
			<div class='resort-icon-description-item ' id='$obj->iconID'>
				<div class='container resort-icon-description-container'>
					<div class='row'>
						<div class='col-12 amenities-item-header' >
							<div class='feature-icon'>
								<div class='feature-icon-content'>
										$img
									<div class='feature-icon-text'>
										<h4>$obj->imgText										
										</h4>
										<i class='icon-rounded-down'></i>
									</div>
								</div>
							</div>
						</div>
						<div class='col-12 amenities-item-content'>
							<div class='resort-icon-description-item-content'>
								<h3 class='resort-icon-description-item-header'>
									$obj->contentHeader
								</h3>
									$obj->contentBody
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
HTML;
	}

	function resortOverviewFeatureIconTemplate(ResortIconContent $obj) {
		if(!isset($obj))
			return;
		$img = getImageTag($obj->imgSrc, $obj->imgAlt, NULL, TRUE);
		$header = htmlspecialchars($obj->contentHeader, ENT_QUOTES);
		$content = htmlspecialchars($obj->contentBody, ENT_QUOTES);
		return <<<HTML
			<div class='features-item' id='$obj->iconID' data-amenity-header='$header' data-amenity-content='$content'>
				<div class='feature-icon'>
					<div class='feature-icon-content'>
						<div class='feature-icon-img'>
							$img
						</div>
						<h4 class='feature-icon-text'>$obj->imgText</h4>
					</div>
				</div>
			</div>
HTML;
	}

	function resortFeatureItemDescriptionTemplate(ResortIconContent $obj ) {
		if(!isset($obj) || empty($obj->contentBody) || empty($obj->contentHeader))
			return;
			$img = getImageTag($obj->imgSrc, $obj->imgAlt, NULL, TRUE);

		return <<<HTML
			<div class='col-12 col-sm-12 col-md-12 col-lg-6 resort-icon-description-item'>
					<div class='container resort-icon-description-container'>
						<div class='row'>
							<div class='col-xs-6 col-sm-4'>
								<div class='feature-icon'>
									<div class='feature-icon-content'>
										<div class='feature-icon-img'>
											$img
										</div>
										<h4 class='feature-icon-text'>$obj->imgText</h4>
									</div>
								</div>
							</div>
							<div class='col-xs-6 col-sm-8'>
								<div class='resort-icon-description-item-content'>
									<h3 class='resort-icon-description-item-header'>
										$obj->contentHeader
									</h3>
										$obj->contentBody
								</div>
							</div>
						</div>
					</div>
				</div>
HTML;
	}

	function resortFeatureContent(array $resortFeatureItemElements) {
		if (isset($resortFeatureItemElements) && !empty($resortFeatureItemElements)) {
			$toReturn = "<div class='container-fluid'><div class='row'>";
			foreach($resortFeatureItemElements as $item) {
				$toReturn .= (string)resortFeatureItemDescriptionTemplate($item);
			}
			$toReturn .= "</div></div>";
			return $toReturn;
		}
	}

	function checkForSpecialMarks($toCheck, $extraSupClass = '') {
		if(strpos($toCheck, "®") !== false) {
			$toCheck = str_replace("®", empty($extraSupClass) === FALSE ? "<span class='" . $extraSupClass . "'>&reg;</span>" : "<sup>&reg;</sup>", $toCheck);
		}
		if(strpos($toCheck, "(SM);") !== false) {
			$toCheck = str_replace("(SM);", empty($extraSupClass) === FALSE ? "<span class='" . $extraSupClass . "'>&#8480;</span>" : "<sup>&#8480;</sup>", $toCheck);
		}
		if(strpos($toCheck, "(SM)") !== false) {
			$toCheck = str_replace("(SM)", empty($extraSupClass) === FALSE ? "<span class='" . $extraSupClass . "'>&#8480;</span>" : "<sup>&#8480;</sup>", $toCheck);
		}
		if(strpos($toCheck, "℠") !== false) {
			$toCheck = str_replace("℠", empty($extraSupClass) === FALSE ? "<span class='" . $extraSupClass . "'>&#8480;</span>" : "<sup>&#8480;</sup>", $toCheck);
		}
		if(strpos($toCheck, "©") !== false) {
			$toCheck = str_replace("©", empty($extraSupClass) === FALSE ? "<span class='" . $extraSupClass . "'>&copy;</span>" : "<sup>&copy;</sup>", $toCheck);
		}
		return $toCheck;
	}

	function heroElementTemplate($title, $imgSrc, $imgAlt, array $contentElements, $extraClassesImg = '') {
		$imageElementSrc = $GLOBALS['img_path'] . $imgSrc;
		$content = "";
		foreach($contentElements as $contentElement) {
			if (!emptyOrNull($contentElement->contentTitle)) {
				$content .= "<h3 class='title'>" . $contentElement->contentTitle . "</h3>";
			}
			if (!emptyOrNull($contentElement->contentParagraph)) {
				if(!emptyOrNull($contentElement->contentClass)) {
					$content .= "<p class='" . $contentElement->contentClass . "'>" . $contentElement->contentParagraph . "</p>";
				} else {
					$content .= "<p>" . $contentElement->contentParagraph . "</p>";
				}
			}
			if (!emptyOrNull($contentElement->buttonText)) {
				$content .= "<a class='btn marriott-btn' href='" . $contentElement->buttonHref . "' role='button'>" . $contentElement->buttonText . "</a>";
			}
		}
		return <<<HTML
		<div class='container-fluid hero-element'>
			<div class='row'>
				<div class='col-xl-4'>
					<div class='hero-element-info'>
						<h1 class='hero-element-info-header'>
							$title
						</h1>
						<div class='break'>
							<hr />
						</div>
						<div class='hero-element-info-body'>
							$content
						</div>
					</div>
				</div>
				<div class='col-xl-8 cover-picture-container'>
					<img class='content $extraClassesImg' src='$imageElementSrc' alt='$imgAlt' width='100%'>
				</img>
				</div>
			</div>
		</div>
HTML;
	}
?>
