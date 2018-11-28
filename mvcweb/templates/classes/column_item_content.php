<?php
	class ColumnItemContent {
		public $imgPath = '';
		public $imgAlt = '';
		public $contentHeader = '';
		public $contentParagraph = '';
		public $buttonText = '';
		public $buttonHref = '';
		public $buttonID = '';
		public $extraClasses = NULL;

		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
