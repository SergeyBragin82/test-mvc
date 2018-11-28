<?php
	class HeroContent {
		public $contentTitle = '';
		public $contentParagraph = '';
		public $contentClass= '';
		public $buttonText = '';
		public $buttonHref = '#';

		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
