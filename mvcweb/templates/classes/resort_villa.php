<?php
	class ResortVilla {
		public $pk = "";
		public $villaHeader = "";
		public $villaIntro = "";
		public $villaType = "";
		public $villaDetails = "";
		public $villaAmenitites = "";
		public $idx = 0;
		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
