<?php
	class FormJson {
		public $messageTemplateID = 0;
		public $messageTypeID = 120;
		public $messageStatusID = 10;
		public $workQueueID = 136;
		public $prefix = "";
		public $suffix = "";
		public $firstName = "";
		public $middleName = "";
		public $lastName = "";
		public $addressLine1 = "";
		public $addressLine2 = "";
		public $addressCity = "";
		public $addressCounty = "";
		public $addressStateProvince = "";
		public $addressPostalCode = "";
		public $addressCountryCode = "";
		public $daytimeTelephoneNumber = "";
		public $eveningTelephoneNumber = "";
		public $emailAddress = "";
		public $mrn = "blank";
		public $iin = "blank";
		public $data = "";
		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
 ?>
