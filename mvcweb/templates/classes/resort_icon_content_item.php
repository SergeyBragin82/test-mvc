<?php
	class ResortIconContent {
    public $imgSrc = '';
    public $imgAlt = '';
    public $imgText = '';
    public $contentHeader = '';
		public $contentBody = '';
		public $iconID = '';
		public $activityTitle = '';
		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
