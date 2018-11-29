<?php
	class RegionDestination {
		public $country = '';
		public $region = '';
		public $state = '';
		public $city = '';

		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
