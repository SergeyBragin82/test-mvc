<?php
	class RequestInfo {
		public $workQueueID = 136;
		public $messageTemplateID = 0;
		public $messageTypeID = 120;
		public $messageStatusID = 10;
		public $prefix = "";
		public $firstName = "";
		public $lastName = "";
		public $emailAddress = "sfdsa@sdfs.com";
		public $addressLine1 = "";
		public $addressLine2 = "";
		public $addressCity = "";
		public $addressCounty = "";
		public $addressPostalCode = "";
		public $addressStateProvince= "";
		public $daytimeTelephoneNumber = "1234567890";
		public $eveningTelephoneNumber = "";
		public $ownerSelection = "I'm not an owner";
		public $formId = "https://www.marriottvacationclub.com/contact-us/index.shtml";
		public $originLOC = "DB59*1-H902RV";
		public $optIn = "true";

		public $webCrmContent = "<TABLE><TR><TD COLSPAN='2'>MVC Request Information Main Form</TD></TR><TR><TD><STRONG>I would like to be contacted about :</STRONG></TD><TD>Im an Owner and have questions about my account or vacation plans</TD></TR><TR><TD><STRONG>Prefix :</STRONG></TD><TD></TD></TR><TR><TD><STRONG>First Name :</STRONG></TD><TD>Test</TD></TR><TR><TD><STRONG>Last Name :</STRONG></TD><TD>Test</TD></TR><TR><TD><STRONG>Country :</STRONG></TD><TD>USA</TD></TR><TR><TD><STRONG>Address Line 1 :</STRONG></TD><TD>rewa</TD></TR><TR><TD><STRONG>City :</STRONG></TD><TD>rewq</TD></TR><TR><TD><STRONG>State/Province :</STRONG></TD><TD>AL</TD></TR><TR><TD><STRONG>Zip Code :</STRONG></TD><TD>21321</TD></TR><TR><TD><STRONG>Phone :</STRONG></TD><TD>1234567890</TD></TR><TR><TD><STRONG>Email :</STRONG></TD><TD>sfdsa@sdfs.com</TD></TR><TR><TD><STRONG>Email Opt-in :</STRONG></TD><TD>true</TD></TR><TR><TD><STRONG>Phone Opt-in :</STRONG></TD><TD>true</TD></TR><TR><TD><STRONG>Mail Opt-in :</STRONG></TD><TD>true</TD></TR><TR><TD><STRONG>LOC :</STRONG></TD><TD>IM59*1-3HY7FS</TD></TR><TR><TD><STRONG>Form Id :</STRONG></TD><TD>IM59*1-3HY7FS</TD></TR><TR><TD><STRONG>Form URL :</STRONG></TD><TD>https://test.www.marriottvacationclub.com/request-information/index.shtml</TD></TR><TR><TD><STRONG>Referring URL :</STRONG></TD><TD></TD></TR></TABLE>";

		public $formURL = "https://test.www.marriottvacationclub.com/request-information/index.shtml";

		//missing
		public $formTitle = "MVC Request Information Main Form";
		public $visitorId = "20170814-14340647-626";
		public $referringURL = "";
		public $sourceId = "";
		public $isHomeOwner = "";
		public $isMarried = "";
		public $miRewardsNumber = "";
		public $spouseName = "";
		public $currentOwner = "";
		public $mvciDestination = "";
		public $mvciResort = "";


		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
