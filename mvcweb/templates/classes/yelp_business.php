<?php
	class YelpBusiness {
		public $name = "";
		public $image_url = "";
		public $urlLink = "";
		public $category = "";

		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
